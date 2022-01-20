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
 * @package     mod_daddyvideo
 * @category    string
 * @copyright   2021 TxC2 <info@txc2.eu>
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['pluginname'] = 'DADdy video';
$string['modulename'] = 'DADdy video';
$string['modulenameplural'] = 'DADdy video';
$string['modulename_help'] = 'Il modulo DADdy video permette al docente di caricare un file video di una lezione mettendo a disposizione degli studenti un player avanzato per la fruizione della lezione.

Una volta creata la risorsa, sarà data la possibilità di selezionare il file video e saranno richieste alcune informazioni sulla lezione. Il video sarà poi elaborato in pochi minuti.

Il player video comprende funzionalità avanzate per agevolare la fruizione da parte dello studente, tra cui il rilevamento automatico delle slide, la suddivisione in sezioni, l\'estrazione di parole chiave, la modalità turbo, ecc.';
$string['daddyvideoname'] = 'Titolo';
$string['pluginadministration'] = 'Amministrazione plugin DADdy video';
$string['noresources'] = 'Nessuna risorsa video trovata in questo corso.';

$string['form_remoteuuid'] = 'UUID remoto';
$string['form_gotoupload'] = 'Crea e vai al caricamento del video';
$string['form_uploadhint_label'] = 'Caricamento video';
$string['form_uploadhint_text'] = 'Per caricare il file video, procedi salvando la risorsa. Avrai poi la possibilità di effettuare l\'upload.';

$string['daddyvideo:addinstance'] = 'Aggiungere risorse video';

$string['setting_lti_provider_url'] = 'URL provider LTI';
$string['setting_lti_provider_url_desc'] = 'L\'URL base del provider LTI, che ti è stato fornito.';
$string['setting_lti_key'] = 'LTI key';
$string['setting_lti_key_desc'] = 'La consumer key LTI che ti è stata fornita.';
$string['setting_lti_secret'] = 'LTI secret';
$string['setting_lti_secret_desc'] = 'La password segreta LTI che ti è stata fornita.';

$string['error_popup_title'] = 'Errore';
$string['error_popup_message'] = 'Si è verificato un errore inaspettato nella preparazione dell\'upload. Ricarica la pagina e riprova.';
$string['error_popup_button'] = 'Ricarica';

$string['error_not_configured'] = 'URL del provider LTI mancante. Per favore contatta il supporto.';
