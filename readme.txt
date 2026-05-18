=== pixelskit-wolt ===
Contributors: PixelsKit
Tags: woocommerce, wolt, venuful, integration
Requires at least: 4.6
Tested up to: 6.9.1
Stable tag: 2.0.4
Requires PHP: 7.0
License: GPLv2 or later

Το πρόσθετο pixelskit-wolt συνδέει τους Venueful συνεργάτες της Wolt με το WooCommerce.

== Description ==

Το πρόσθετο pixelskit-wolt συνδέει τους Venueful συνεργάτες της Wolt με το WooCommerce. Σε πραγματικό χρόνο στέλνει αποθέματα/πληροφορίες προς ένα ή περισσότερα Wolt καταστήματα.

== Installation ==

Ανεβάστε το συμπιεσμένο αρχείο του pixelskit-wolt στο WordPress για να ξεκινήσετε τη διαδικασία εγκατάστασης. Τα βήματα εγκατάστασης είναι τα εξής:

1. Από το μενού διαχείρισης επιλέγετε Πρόσθετα, και συγκεκριμένα Νέο Πρόσθετο.
2. Εκεί θα εντοπίσετε πάνω αριστερά το κουμπί Μεταφόρτωση αρχείου. Μόλις το πατήσετε θα εμφανιστεί η φόρμα προσθήκης αρχείου.
3. Επιλέγοντας το κουμπί Επιλογή αρχείου, θα σας εμφανιστεί ένα παράθυρο. Σε αυτό εντοπίστε το zip αρχείο, που αποθηκεύσατε προηγουμένως, και πατήστε το κουμπί Εγκατάσταση τώρα.
4. Μόλις το πρόσθετο ανέβει με επιτυχία στην ιστοσελίδα σας θα σας ζητηθεί να το ενεργοποιήσετε. Σε αυτό το σημείο θα επιλέξετε το κουμπί ενεργοποίησης και το προσθετό σας έχει εγκατασταθεί και ενεργοποιηθεί με επιτυχία.
5. Τέλος, μεταβείτε στις ρυθμίσεις και ορίζετε τις παραμέτρους που λείπουν.

== Changelog ==

= 2.0.4 =
* Queue Wolt syncs when WooCommerce stock quantity or stock status changes.
* Treat in-stock products without a managed stock quantity as available inventory instead of sending zero.

= 2.0.3 =
* Rebrand the plugin and installable package to pixelskit-wolt.
* Replace the legacy admin menu, support link, package metadata, and readme references.

= 2.0.2 =
* Remove legacy license validation and all license-gated feature restrictions.
* Remove the legacy update-checker license query integration.

= 2.0.1 =
* Add native support for syncing inventory and items to multiple Wolt venue IDs.
* Add support for multiple Order API keys for manual order fetches and webhooks.
* Fix packaged include paths so the plugin loads from the expected WordPress structure.

= 2.0.0 =
* Βελτίωση: Ανανεωμένο περιβάλλον διαχείρισης

= 1.0.32 =
* Προσθήκη: ΦΠΑ σε CSV/XML
* Διόρθωση: Βελτίωση των requests

= 1.0.31 =
* Προσθήκη: Χρήση μονάδων ζυγίσματος

= 1.0.30 =
* Προσθήκη: Δυνατότητα τιμολογίου

= 1.0.29 =
* Προσθήκη: Δυνατότητα απενεργοποίησης τιμών

= 1.0.28 =
* Διόρθωση: HPOS και διαχειριστικό

= 1.0.27 =
* Προσθήκη: Barcode σε csv/xml
* Διόρθωση: Κατηγορίες ειδών

= 1.0.26 =
* Διόρθωση: Προσθήκη ID παραλλαγής

= 1.0.25 =
* Διόρθωση: Προσθήκη ID παραλλαγής

= 1.0.24 =
* Διόρθωση: Κλήσεις προς Wolt

= 1.0.23 =
* Προσθήκη: Προσθήκη XML

= 1.0.22 =
* Προσθήκη: Hooks

= 1.0.21 =
* Προσθήκη: Δημιουργία log files

= 1.0.20 =
* Διόρθωση: Διαφορά τιμής σε options
* Διόρθωση: Απενεργοποίηση ειδοποιήσεων μέσω mail

= 1.0.19 =
* Διόρθωση: Παραγωγή XML

= 1.0.18 =
* Προσθήκη: Φίλτρο απόκρυψης ειδών
* Προσθήκη: Ενσωμάτωση παραλλαγών στο κύριο νήμα

= 1.0.17 =
* Διόρθωση: Κλήσεις για στοκ παραλλαγών

= 1.0.15 =
* Προσθήκη: Υποστήριξη XML παραλλαγών
* Προσθήκη: Υποστήριξη CSV παραλλαγών
* Διόρθωση: Κλήσεις για στοκ παραλλαγών

= 1.0.14 =
* Προσθήκη: Υποστήριξη παραλλαγών

= 1.0.13 =
* Διόρθωση: PHP 8.1

= 1.0.12 =
* Προσθήκη: Custom stock hook

= 1.0.11 =
* Διόρθωση: Ακυρωμένες παραγγελίες
* Διόρθωση: wp_mail

= 1.0.10 =
* Διόρθωση: Άνοιγμα ειδών στο WC Order

= 1.0.9 =
* Διόρθωση: Δημιουργία παραγγελίας και πολλαπλά προϊόντα

= 1.0.8 =
* Διόρθωση: Wolt Order ID
* Διόρθωση: Εικόνα καταλόγου

= 1.0.7 =
* Προσθήκη: Μέθοδος πληρωμής Wolt
* Διόρθωση: Αντικατάσταση order number με order_id

= 1.0.6 =
* Διόρθωση: Αφαίρεση μη ενεργών ειδών

= 1.0.5 =
* Διόρθωση: Εκπτώσεις και τιμές

= 1.0.4 =
* Προσθήκη: Δυνατότητα απενεργοποίησης εικόνων
* Προσθήκη: Αφαίρεση μεταβλητών ειδών
* Προσθήκη: Μηχανισμός διαγραφής ειδών

= 1.0.3 =
* Διόρθωση: Φίλτρο κοινών sku

= 1.0.2 =
* Προσθήκη: Export CSV/XML

= 1.0.1 =
* Προσθήκη: Orders API

= 1.0.0 =
* Αρχική έκδοση
