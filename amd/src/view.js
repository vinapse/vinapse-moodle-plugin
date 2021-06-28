import * as Str from 'core/str';
import Ajax from 'core/ajax';
import Notification from 'core/notification';
import ModalEvents from 'core/modal_events';

const PREFIX = 'mod_daddyvideo:';

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

    window.console.log(`${PREFIX} Setting UUID ${event.data.uuid} for cmid ${cmid}`);

    Ajax.call([{
        methodname: "mod_daddyvideo_set_uuid",
        args: {cmid: cmid, uuid: event.data.uuid},
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
                        window.location.reload(true);
                    });
                });
        }
    }]);
}
