HowTo Mail Server Fingerprint
=============================

Fetching the SSL Cert from a remote mail server, and extracting the SHA1 Fingerprint
------------------------------------------------------------------------------------

This is useful for let's say when you need the fingerprint to identify via TLS

Get the raw certificate:

	echo Q | openssl s_client -connect mail.example.com:443

Copy and paste the scribble from -----BEGIN CERTIFICATE----- to -----END CERTIFICATE----- to a file called cert.pem. Including -----BEGIN CERTIFICATE----- as first and -----END CERTIFICATE----- as last line.

Generate the SHA1 fingerprint by issuing following command:

	openssl x509 -in cert.pem -sha1 -noout -fingerprint

