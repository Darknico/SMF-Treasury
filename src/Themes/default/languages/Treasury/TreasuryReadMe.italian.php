<?php

$txt['treasury_readme_installedVersion'] = 'Versione installata';
$txt['treasury_readme_checkVersionVersion'] = 'Controlla l\'ultima versione disponibile su';

// title
$txt['treasury_readme_info_title'] = 'Informazioni Treasury';
$txt['treasury_readme_treasSetup_title'] = 'Configurazione modulo Treasury';
$txt['treasury_readme_paypalSetup_title'] = 'Configurazione account PayPal';
$txt['treasury_readme_operationalNote_title'] = 'Note operative';
$txt['treasury_readme_unistallNote_title'] = 'Note sulla disinstallazione';

// description
$txt['treasury_readme_info_description'] = 
'Treasury ti consente di ricevere e gestire le donazioni tramite PayPal.<br>
In questa pagina puoi leggere tutte le informazioni per l\'utilizzo.';

$txt['treasury_readme_treasSetup_description'] = 
'<ol>
<li>Dato che sei qui, presumo che tu abbia installato correttamente e seguito le istruzioni fornite nelle note del pacchetto.<br><br></li>
<li>Nella scheda <a href="%2$ssa=configpaypal" style="text-decoration:underline;"><strong>PayPal</strong></a>, assicurati di inserire il tuo indirizzo email di PayPal (e la valuta principale PayPal): non funzionerà con la email predefinita.<br><br></li>
<li>Se sai come utilizzare la "sandbox" di PayPal, puoi testare tutto ciò che desideri dopo aver creato un account sviluppatore (gratuito) con PayPal. La sandbox è stata utilizzata per eseguire il debug di questo modulo.<br>In caso contrario, chiedi a un amico di effettuare alcune donazioni di prova, a meno che tu non abbia un secondo conto PayPal da utilizzare. Puoi rimborsarli tramite il tuo conto PayPal, senza commissioni o penalità.<br><br></li>
<li>Controlla le altre opzioni nell\'amministrazione per impostare l\'aspetto del <a href="%2$ssa=config" style="text-decoration:underline;"><strong>Modulo</strong></a> ( ed il <a href="%2$ssa=configblock" style="text-decoration:underline;"><strong>Blocco</strong></a> per gli utenti del portale).<br><br></li >
<li>Dovrai impostare le <a href="%1$s?action=admin;area=permissions" style="text-decoration:underline;"><strong>autorizzazioni</strong></a> di visualizzazione ed amministrazione per ciascun gruppo di utenti.<br><br></li>
<li>Se desideri cambiare il nome che appare nella barra dei menu da Donazioni a qualcos\'altro, puoi modificare il valore di $txt[\'treasury_menu\'] in "Themes/default/languages/Treasury/Treasury.italian.php". <br><br></li>
<li>I tuoi obiettivi mensili vengono visualizzati nella pagina <a href="%1$s?action=treasury" style="text-decoration:underline;"><strong>Treasury</strong></a>.<br><br></li>
</ol>';

$txt['treasury_readme_paypalSetup_description'] = 
'Se scegli di ignorare questo consiglio, chiedi a PayPal: verranno pagati per rispondere alle tue domande.
Non intendo essere scortese, ma le informazioni vengono fornite per una buona ragione, quindi puoi aiutarti da solo.<br><br>
Se riscontri problemi e non hai pieno accesso al profilo del conto PayPal, non contattarci: è impossibile risolvere il problema quando non puoi verificare direttamente le impostazioni o le modifiche del conto.<br><br>
Lascio a te la scelta del conto PayPal: <strong>non</strong> fornirò consigli su questo problema.
Dopo una precedente esperienza spiacevole, non mi lascerò esporsi ad assurde minacce di azioni legali.<br>
<ol>
<li>Treasury richiede le impostazioni IPN nel "Profilo" del tuo conto PayPal.<br>
&#8226; Imposta "IPN" su "On" nelle "Preferenze di notifica di pagamento istantaneo".<br>
&#8226; Ciò richiederà anche l\'inserimento di un URL: va bene qualsiasi cosa, ma non lasciarlo vuoto.<br>
<br>
L\'URL impostato qui NON è importante poiché Treasury opera dai propri URL di notifica e restituzione che ignorano e sono indipendenti dalle impostazioni PayPal.<br>
&#8226; <strong>Perché?</strong> Se hai già attivato un\'impostazione IPN per qualche altro programma, continuerà a funzionare per quel programma.<br>
&#8226; <strong>Esempio?</strong> Se hai già impostato l\'URL IPN in modo da poter utilizzare, ad esempio, gli abbonamenti a pagamento, puoi lasciare l\'URL su PayPal così com\'è e utilizzare comunque Treasury.<br><br></li>
<li>Dovresti anche modificare le "Preferenze per la ricezione dei pagamenti" nella tua area "Profilo".<br>
&#8226; Seleziona l\'opzione "Blocca i pagamenti che mi sono stati inviati in una valuta che non possiedo:".<br>
&#8226; Dovresti impostarlo sulla seconda opzione "No, accettali e convertili...".<br>
<br><strong>In caso</strong> contrario, dovrai confermare manualmente ogni pagamento nel tuo conto PayPal e la donazione NON verrà visualizzata sul tuo sito.<br><br></li>
<li>Impostazioni di Treasury in "Preferenze di pagamento del sito web".<br>
   È necessario impostare,<br>
&#8226; Imposta/Lascia "Ritorno automatico" su "Attiva", <strong>ripeti "Attiva"</strong> in "Preferenze di pagamento sul sito web".<br>
&#8226; Imposta/Lascia \'Trasferimento dati pagamento\' su \'Disattivato\' nelle "Preferenze di pagamento del sito web".<br><br></li>
<li>Impostazioni in "Saldo valute".<br>
Non dovrebbe essere necessario modificarli: l\'impostazione predefinita di PayPal va bene: una valuta primaria aperta e tutte le altre valute chiuse.<br>
Se non hai ragioni particolari per operare con più valute aperte, NON giocherellare!<br>
Se hai motivi speciali, <strong>non riceverai il tasso di cambio e non liquiderai gli importi da PayPal</strong> per le valute non primarie che hai aperto.<br>
Dovrai modificare manualmente tutte le transazioni di Tesoreria per le valute che ricevi che non sono la tua valuta principale!<br><br></li>
</ol>';

$txt['treasury_readme_operationalNote_description'] = 
'<ol>
<li>La scheda <a href="%2$ssa=registry" style="text-decoration:underline;"><strong>Registro</strong></a> ti consente di gestire le <strong>ricevute del tuo sito &amp; spese</strong> con voci di base per registrarle. Puoi anche sommare i tuoi contributi utente più recenti come una singola voce nel registro mediante la <a href="%2$ssa=registry" style="text-decoration:underline;"><strong>Riconciliazione</strong></a> delle tue ricevute PayPal. Se desideri fornire un\'informativa completa ai tuoi donatori, puoi scegliere di visualizzare un riepilogo del tuo reddito e delle tue entrate &amp; spese a loro carico.<br><br></li>
<li>Il <a href="%2$ssa=configblock" style="text-decoration:underline;"><strong>Blocco</strong></a> viene fornito per le installazioni del Portale in cui è possibile avere un blocco laterale. Ti consente di visualizzare il tuo attuale obiettivo di donazione mensile e quali fondi sono stati ricevuti per raggiungere tale obiettivo. La visualizzazione degli obiettivi e/o il misuratore dei donatori è ora selezionabile. Elenca anche gli utenti che hanno contribuito nel periodo corrente.<br>La pagina principale di Treasury fornisce già tutte queste informazioni.<br><br></li>
<li>Sono presenti suggerimenti di aiuto per le opzioni di amministrazione che ne descrivono l\'utilizzo.<br>Basta fare clic sul punto interrogativo per visualizzare le descrizioni.<br><br></li>
<li>Treasury esaminerà periodi di tempo diversi, a seconda dell\'opzione scelta: mensile, trimestrale, semestrale e annuale. In alternativa, puoi scegliere di gestire le donazioni in base agli eventi, con obiettivi prefissati per ciascuna campagna di donazioni.<br><br></li>
<li>Gli utenti possono visualizzare il riepilogo delle donazioni personali tramite il loro <a href="%1$s?action=profile;area=showdonations;u=1" style="text-decoration:underline;"><strong>Profilo</strong></a> - visualizzabile solo dall\'utente o dall\'amministratore.<br><br></li>
<li>Treasury terrà conto anche di eventuali rimborsi elaborati: annullerà automaticamente la donazione originale e un record verrà salvato nel registro delle transazioni. Il profilo del donatore mostrerà la donazione originale così come il rimborso.<br><br></li>
<li>Hai ricevuto un <strong>errore 500</strong> dal server interno quando PayPal ritorna al tuo sito?<br>Controlla che i permessi del file per %3$s/ipntreas.php siano 644 o 755 (CHMOD a 644 se sono 777 o 666).<br>Allo stesso modo se stai utilizzando %3$s/Sources/Treasury/DonationBlock.php in un portale.<br><br></li>
<li>Puoi verificare che il tuo sito risponderà a PayPal <a href="%3$s/ipntreas.php?dbg=1" style="text-decoration:underline;" target="_blank"><strong>facendo clic qui</strong></a>.<br>
&#8226; Ciò inserirà anche una voce nel tuo <a href="%2$ssa=translog" style="text-decoration:underline;"><strong>registro delle transazioni</strong></a>.<br><br </li>
<li>Se riscontri problemi con le transazioni che non vengono visualizzate, controlla il <a href="%2$ssa=translog" style="text-decoration:underline;"><strong>Registro delle transazioni</strong></a > per eventuali indizi sui problemi.<br>
&#8226; se pagano tramite echeck (3 giorni per cancellare) il registro conterrà "pending_reason => echeck".<br><br></li>
<li>Ogni volta che i dati IPN non sono archiviati nel tuo database, dovrai inserire manualmente i dati dalla tua email PayPal nella riga inferiore <a href="%2$ssa=donations" style="text-decoration:underline;"><strong>qui</strong></a>.<br><br></li>
<li>Treasury accetta pagamenti in sospeso, come eCheck, e memorizza le informazioni nel database, con lo stato "Pending". Quando l\'eCheck viene cancellato, ora dovrebbe ricevere le informazioni IPN PayPal e aggiornare automaticamente il tuo database, altrimenti puoi modificare lo stato in "Completato" in <a href="%2$ssa=donations" style="text-decoration:underline;"><strong>Donazioni</strong></a> e le donazioni verranno visualizzate nei tuoi obiettivi e nell\'elenco dei donatori: dovrai aggiungere i dati per la quota, saldare l\'importo e il tasso di cambio.<br><br></li>
<li>Donazioni basate sugli eventi: questa è un\'alternativa al sistema di donazioni esistente basato sul tempo.<br>Scegli l\'uno o l\'altro, <strong>non supporta entrambi</strong> contemporaneamente.<br>Lo farà solo per una campagna di eventi alla volta e devi decidere quando terminare una determinata campagna.<br><br></li>
<li>Treasury è stato inizialmente progettato per un uso multiuso, raccogliendo informazioni sulla base delle transazioni PayPal per diversi indirizzi e-mail.<br>
&#8226; ciò significa che è previsto che il campo "aziendale" per una transazione corrisponda all\'indirizzo "e-mail del destinatario" specificato nella scheda <a href="%2$ssa=configpaypal" style="text-decoration:underline;">scheda <strong>Configurazione PayPal</strong></a>.<br>
&#8226; se i due non corrispondono, la donazione verrà ignorata nei riepiloghi, quindi dovrai modificare il campo "azienda" nella tabella "smf_treas_donations" del tuo database.<br>(forse nelle versioni successive utilizzeremo questa funzionalità).<br><br></li>
<li>La barra verde sotto il riepilogo dell\'obiettivo (vicino alla parte inferiore del blocco per gli utenti del portale) indica la percentuale di raggiungimento del tuo obiettivo mensile.<br><br></li>
</ol>';

$txt['treasury_readme_unistallNote_description'] = 
'<ol>
<li>La disinstallazione rimuove tutti i file e gli hooks</li>
<li>Nota: durante la disinstallazione <strong>NON</strong> vengono rimosse le tabelle di Treasury dal database.<br>
Per una completa disinstallazione bisogna <strong>ELIMINARE</strong> queste tabelle nel database:<br>
- smf_log_treasurey<br>
- smf_treas_config<br>
- smf_treas_donations<br>
- smf_treas_events<br>
- smf_treas_registry<br>
- smf_treas_subscribers<br>
- smf_treas_targets<br>
(assumendo che venga utilizzato smf_ come prefisso)<br><br></li>
</ol>';

?>