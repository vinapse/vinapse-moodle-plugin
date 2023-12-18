<?php
// This file is part of Moodle - https://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <https://www.gnu.org/licenses/>.

/**
 * Plugin strings are defined here.
 *
 * @package     mod_vinapse
 * @category    string
 * @copyright   2021 TxC2 <info@txc2.eu>
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['pluginname'] = 'Vinapse';
$string['modulename'] = 'Video Vinapse';
$string['modulenameplural'] = 'Video Vinapse';
$string['modulename_help'] = 'Il modulo Vinapse video permette al docente di caricare un file video di una lezione mettendo a disposizione degli studenti un player avanzato per la fruizione della lezione.

Una volta creata la risorsa, sarà data la possibilità di selezionare il file video e saranno richieste alcune informazioni sulla lezione. Il video sarà poi elaborato in pochi minuti.

La piattaforma Vinapse comprende un player video avanzato con funzionalità intelligenti per agevolare la fruizione da parte dello studente, tra cui il rilevamento automatico delle slide, la suddivisione in capitoli, l\'estrazione di parole chiave, la modalità turbo, ecc.';
$string['vinapsename'] = 'Titolo';
$string['pluginadministration'] = 'Amministrazione plugin Vinapse';
$string['noresources'] = 'Nessuna risorsa video trovata in questo corso.';

$string['form_remoteuuid'] = 'UUID Vinapse';
$string['form_gotoupload'] = 'Crea e vai al caricamento del video';
$string['form_uploadhint_label'] = 'Caricamento video';
$string['form_uploadhint_text'] = 'Per caricare il file video, procedi salvando la risorsa. Avrai poi la possibilità di effettuare l\'upload.';

$string['vinapse:addinstance'] = 'Aggiungere risorse video';

$string['setting_lti_provider_url'] = 'URL provider LTI';
$string['setting_lti_provider_url_desc'] = 'L\'URL base del provider LTI, che ti è stato fornito.';
$string['setting_lti_key'] = 'LTI key';
$string['setting_lti_key_desc'] = 'La consumer key LTI che ti è stata fornita.';
$string['setting_lti_secret'] = 'LTI secret';
$string['setting_lti_secret_desc'] = 'La password segreta LTI che ti è stata fornita.';

$string['error_popup_title'] = 'Errore';
$string['error_popup_message'] = 'Si è verificato un errore inaspettato nella preparazione dell\'upload. Ricarica la pagina e riprova.';
$string['error_popup_button'] = 'Ricarica';

$string['error_not_configured'] = 'URL del provider LTI mancante. Completa la configurazione o se hai bisogno di aiuto contatta l\'assistenza.';

$string['launch_guest_title'] = 'Autenticazione richiesta';
$string['launch_guest_description'] = 'Gli ospiti non possono accedere alla piattaforma. Effettua il login.';
