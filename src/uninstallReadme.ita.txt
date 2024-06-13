[b]La disinstallazione rimuove tutti i file e gli hooks[/b]
[hr]
Nota: durante la disinstallazione [b]NON[/b] vengono rimosse le tabelle di Treasury dal database.
Per una completa disinstallazione bisogna [b]ELIMINARE[/b] queste tabelle nel database:
- smf_log_treasurey
- smf_treas_config
- smf_treas_donations
- smf_treas_events
- smf_treas_registry
- smf_treas_subscribers
- smf_treas_targets
(assumendo che venga utilizzato smf_ come prefisso)