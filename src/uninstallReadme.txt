[b]The uninstall remove all file and all hooks[/b]
[hr]
Note: Uninstall will deliberately [b]NOT[/b] remove the Treasury database tables.
For permanent Uninstall you will need to manually [b]DROP[/b] these tables from the database:
- smf_log_treasurey
- smf_treas_config
- smf_treas_donations
- smf_treas_events
- smf_treas_registry
- smf_treas_subscribers
- smf_treas_targets
(assumes you used smf_ for your prefix)