Linux Sendmail
==============

#### Howto Test / use sendmail 

	#!/bin/bash
	 
	SENDMAIL=/usr/sbin/sendmail
	RECIPIENT=tosomeone@example.com
	FROM=me@example.com
	
	cat <<EOF | $SENDMAIL -t ${RECIPIENT}
	From: ${FROM} 
	To: ${RECIPIENT}
	Subject: testmail
	 
	some test text as body of the email.
	EOF