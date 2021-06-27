// import * as Str from 'core/str';
import Ajax from 'core/ajax';
import Notification from 'core/notification';
import ModalEvents from 'core/modal_events';

export const init = (cmid) => {
    window.console.log('Registering listener...');
    window.addEventListener('message', onMessage.bind(this, cmid));
};

function onMessage(cmid, event) {
    // TODO: check event.origin
    var data = event.data;
    window.console.log(`Setting UUID ${data.uuid} for cmid ${cmid}`);

    Ajax.call([{
        methodname: "mod_daddyvideo_set_uuid",
        args: {cmid: cmid, uuid: data.uuid},
        fail: (err) => {
            window.console.error(err);

            Notification.alert('Errore', 'Ti dirò.', 'OK').then(function (modal) {
                modal.getRoot().on(ModalEvents.hidden, function () {
                    window.location.reload(true);
                });
            });
        }
    }]);
}
