// This file is part of Moodle - https://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle. If not, see <https://www.gnu.org/licenses/>.

/**
 * @package     mod_vinapse
 * @copyright   2021 TxC2 <info@txc2.eu>
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

import * as Str from 'core/str';
import Ajax from 'core/ajax';
import Notification from 'core/notification';
import ModalEvents from 'core/modal_events';

const PREFIX = 'mod_vinapse:';
let lastRequestedHeight = null;
let windowHeight = window.innerHeight;

/**
 * Initializes the module.
 * @param {number} cmid The course module id
 * @param {string} ltiHostname - The hostname of the LTI provider
 */
export const init = (cmid, ltiHostname) => {
    window.console.log(`${PREFIX} Registering message listener...`);
    window.addEventListener('message', onMessage.bind(this, cmid, ltiHostname));
    window.addEventListener('resize', onWindowResize);
};

/**
 * Handles messages from the LTI provider iframe.
 * @param {number} cmid - The course module id
 * @param {string} ltiHostname - The hostname of the LTI provider
 * @param {MessageEvent} event - The message event
 */
function onMessage(cmid, ltiHostname, event) {
    const origin = new URL(event.origin).hostname;

    if (origin !== ltiHostname) {
        window.console.log(`${PREFIX} Received message from ${event.origin} but expecting ${ltiHostname}, ignoring`);
        return;
    }

    let data = event.data;
    if (data.type === 'reload') {
        reload();
    } else if (data.type === 'resize') {
        setHeight(data.height, data.force);
    } else {
        updateUUID(cmid, data);
    }
}

/**
 * Updates the UUID of the current course module through an AJAX call.
 * @param {number} cmid - The course module id
 * @param {object} data - The message received from the LTI provider
 */
function updateUUID(cmid, data) {
    let uuid = '';
    let shouldReload = false;
    if (data.type === 'update') {
        uuid = data.uuid;
        window.console.log(`${PREFIX} Setting UUID ${uuid} for cmid ${cmid}`);
    } else if (data.type === 'reset') {
        window.console.log(`${PREFIX} Resetting cmid ${cmid}`);
        shouldReload = true;
    } else {
        return;
    }

    Ajax.call([{
        methodname: 'mod_vinapse_set_uuid',
        args: {cmid: cmid, uuid: uuid},
        done: () => {
            if (shouldReload) {
                reload();
            }
        },
        fail: (err) => {
            window.console.error(err);

            // Remove iframe to stop upload
            const iframe = document.getElementById('vinapse-embed');
            iframe.parentNode.removeChild(iframe);

            // Alert the user and refresh on dismiss
            Notification.alert(
                Str.get_string('error_popup_title', 'vinapse'),
                Str.get_string('error_popup_message', 'vinapse'),
                Str.get_string('error_popup_button', 'vinapse'))
                .then(function (modal) {
                    modal.getRoot().on(ModalEvents.hidden, function () {
                        shouldReload();
                    });
                });
        }
    }]);
}

/**
 * Reloads the page.
 */
function reload() {
    window.console.log(`${PREFIX} Reloading...`);
    window.location.reload(true);
}

/**
 * Handles window resize events.
 */
function onWindowResize() {
    if (lastRequestedHeight && window.innerHeight != windowHeight) {
        windowHeight = window.innerHeight;
        setHeight(lastRequestedHeight, false);
    }
}

/**
 * Sets the height of the iframe.
 * @param {number} height - The height to set
 * @param {boolean} force - Whether to force the height, overriding constraints
 */
function setHeight(height, force) {
    if (!force) {
        lastRequestedHeight = height;
        let min = 300;
        let max = window.innerHeight - 270;
        height = constrainBetween(height, min, max);
    } else {
        lastRequestedHeight = null;
    }

    const iframe = document.getElementById('vinapse-embed');
    iframe.style.height = `${height}px`;
    iframe.focus();
}

/**
 * Constrains a value between a minimum and maximum value.
 * @param {number} value
 * @param {number} min
 * @param {number} max
 * @returns {number}
 */
function constrainBetween(value, min, max) {
    value = Math.min(value, max);
    value = Math.max(value, min);
    return value;
}
