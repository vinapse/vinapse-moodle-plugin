/**
 * @package     mod_daddyvideo
 * @copyright   2021 TxC2 <info@txc2.eu>
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

import * as Str from 'core/str';
import Ajax from 'core/ajax';
import Notification from 'core/notification';
import ModalEvents from 'core/modal_events';

const PREFIX = 'mod_daddyvideo:';
let timer;

export const init = (cmid, ltiHostname) => {
    window.console.log(`${PREFIX} Registering message listener...`);
    window.addEventListener('message', onMessage.bind(this, cmid, ltiHostname));
};

function onMessage(cmid, ltiHostname, event) {
    const origin = new URL(event.origin).hostname;

    if (origin != ltiHostname) {
        window.console.log(`${PREFIX} Received message from ${event.origin} but expecting ${ltiHostname}, ignoring`);
        return;
    }

    let data = event.data;
    if (data.type == 'reload') {
        reload();
    } else if (data.type == 'resize') {
        setHeight(data.height);
    } else {
        updateUUID(cmid, data);
    }
}

function updateUUID(cmid, data) {
    let uuid = '';
    let shouldReload = false;
    if (data.type == 'update') {
        uuid = data.uuid;
        window.console.log(`${PREFIX} Setting UUID ${uuid} for cmid ${cmid}`);
    } else if (data.type == 'reset') {
        window.console.log(`${PREFIX} Resetting cmid ${cmid}`);
        shouldReload = true;
    } else {
        return;
    }

    Ajax.call([{
        methodname: "mod_daddyvideo_set_uuid",
        args: {cmid: cmid, uuid: uuid},
        done: () => {
            if (shouldReload) {
                reload();
            }
        },
        fail: (err) => {
            window.console.error(err);

            // Remove iframe to stop upload
            const iframe = document.getElementById('daddyvideo-embed');
            iframe.parentNode.removeChild(iframe);

            // Alert the user and refresh on dismiss
            Notification.alert(
                Str.get_string('error_popup_title', 'daddyvideo'),
                Str.get_string('error_popup_message', 'daddyvideo'),
                Str.get_string('error_popup_button', 'daddyvideo'))
                .then(function (modal) {
                    modal.getRoot().on(ModalEvents.hidden, function () {
                        shouldReload();
                    });
                });
        }
    }]);
}

function reload() {
    window.console.log(`${PREFIX} Reloading...`);
    window.location.reload(true);
}

function setHeight(height) {
    let cap = window.innerHeight - 250;
    height = Math.min(height, cap);
    debounce(() => {
        window.console.log(`${PREFIX} Set iframe height to ${height}`);
    });
    const iframe = document.getElementById('daddyvideo-embed');
    iframe.style.height = (height + 25) + 'px';
}

function debounce(func) {
    clearTimeout(timer);
    timer = setTimeout(func, 1000);
}
