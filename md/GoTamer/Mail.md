GoTamer Mail
============

Simplifies the interface to the go smtp package, and creates a pipe for mail queuing. 

	package main
	
	import "gotamer/mail" // bitbucket.org/gotamer/mail if you install with go get
	
	func main() {

		// use defer when you send with mail.Send(), not needed for mail.Write()
		defer mail.final() 

		s := new(Smtp)
		s.SetHostname("smtp.gmail.com")
		s.SetHostport(587)
		s.SetFromName("GoTamer")
		s.SetFromAddr("xxxx@gmail.com")
		s.SetPassword("********")
		s.AddToAddr("xxxx@yahoo.com")
		s.SetSubject("GoTamer test mail")
		s.SetBody("Let's see if we get this")
		if err := s.Write(); err != nil {
			// Handle your errors here
		}
	}

As an alternative to `AddToAddr()` there is `SetToAddrs()`. With `SetToAddrs()` you can set one or more recipients as a comma separated list. 

#### A note on the host. 
Go SMTP does not allow to connect to SMPT servers with a self signed certs.  

You will get an error like following:

	x509: certificate signed by unknown authority

The way I got around that is by using [CAcert][1]. [CAcert][1] provides FREE digital certificates.

### Links
 * [Pkg Documantation](http://go.pkgdoc.org/bitbucket.org/gotamer/mail "GoTamer Mail Pkg Documentation")
 * [Repository](https://bitbucket.org/gotamer/mail "GoTamer Mail Repository")


[1]: http://www.cacert.org  "CA Cert"
