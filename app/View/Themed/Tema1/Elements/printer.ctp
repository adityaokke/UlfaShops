/**

	* Optionally used to deploy multiple versions of the applet for mixed

	* environments.  Oracle uses document.write(), which puts the applet at the

	* top of the page, bumping all HTML content down.

	*/

	deployQZ();

	

	/**

	* Deploys different versions of the applet depending on Java version.

	* Useful for removing warning dialogs for Java 6.  This function is optional

	* however, if used, should replace the <applet> method.  Needed to address 

	* MANIFEST.MF TrustedLibrary=true discrepency between JRE6 and JRE7.

	*/

	function deployQZ() {

		var attributes = {id: "qz", code:'qz.PrintApplet.class', 

			archive:'<?php echo $this->Html->url(array('controller'=>'transjuals','action'=>'jzebra', 'qz-print.jar')); ?>', width:1, height:1};

		var parameters = {jnlp_href: '<?php echo $this->Html->url(array('controller'=>'transjuals','action'=>'jzebra', 'qz-print_jnlp.jnlp')); ?>', 

			cache_option:'plugin', disable_logging:'false', 

			initial_focus:'false'};

		if (deployJava.versionCheck("1.7+") == true) {}

		else if (deployJava.versionCheck("1.6+") == true) {

			delete parameters['jnlp_href'];

		}

		deployJava.runApplet(attributes, parameters, '1.5');

	}
	var printer='';
	function findPrinter(name) {

		// Get printer name from input box

		//var p = document.getElementById('printer');
		
		//if (name) {

			//p.value = name;

		//}

		

		if (isLoaded()) {

			// Searches for locally installed printer with specified name

			//qz.findPrinter(p.value);

			//use default

			qz.findPrinter();

			// Automatically gets called when "qz.findPrinter()" is finished.

			window['qzDoneFinding'] = function() {

				//var p = document.getElementById('printer');

				//var printer = qz.getPrinter(p.value);

				printer = qz.getPrinter();

				// Alert the printer name to user

				//alert(printer !== null ? 'Printer found: "' + printer + 

				//	'" after searching for "' + p.value + '"' : 'Printer "' + 

				//	p.value + '" not found.');

				// Remove reference to this function

				window['qzDoneFinding'] = null;

			};

		}

	}

	

	function printEPL(cetak,jenis) {

		if (notReady()) { return; }

		// Send characters/raw commands to qz using "append"

		// This example is for EPL.  Please adapt to your printer language

		// Hint:  Carriage Return = \r, New Line = \n, Escape Double Quotes= \"



	  //qz.append('1234567890123456789012345678901234567890\n')
	  	if(jenis==1){
	  		qz.append('\t    ULFA Accecories\n');

			qz.append('\t   GROSIR dan ECERAN\n');

			qz.append('       Jl. Yos Sudarso No 93 SOLO\n');

			qz.append('  HP : 0878 3877 3170 / 0812 2617 7572\n');

			qz.append('  BB : 5786 4CC6\n\n');

			qz.append(cetak);

			qz.append('\n  Barang yang sudah dibeli tidak dapat\n');

			qz.append('       ditukar atau dikembalikan\n');

			qz.append('     Terima Kasih Atas Kunjungannya\n');

			qz.append('        Semoga Laris Dan Barokah\n');
	  	}else if(jenis==2){
	  		qz.append(cetak);
			qz.append('\n');
	  	}
		

		qz.append('\n\n\n\n\n\n\n');

		qz.print();

		//qz.appendImage(getPath());

				

		// Automatically gets called when "qz.appendImage()" is finished.

		window['qzDoneAppending'] = function() {

			// Append the rest of our commands

			

			

			// Tell the applet to print.

			

			// Remove reference to this function

			window['qzDoneAppending'] = null;

		};

	 }

	/**

	* Automatically gets called when applet has loaded.

	*/

	function qzReady() {

		// Setup our global qz object

		window["qz"] = document.getElementById('qz');

		if (qz) {

			try {

			} catch(err) { // LiveConnect error, display a detailed meesage

				alert("ERROR:  \nThe applet did not load correctly.  Communication to the " + 

					"applet has failed, likely caused by Java Security Settings.  \n\n" + 

					"CAUSE:  \nJava 7 update 25 and higher block LiveConnect calls " + 

					"once Oracle has marked that version as outdated, which " + 

					"is likely the cause.  \n\nSOLUTION:  \n  1. Update Java to the latest " + 

					"Java version \n          (or)\n  2. Lower the security " + 

					"settings from the Java Control Panel.");

		  }

	  }

	}

	

	/**

	* Returns whether or not the applet is not ready to print.

	* Displays an alert if not ready.

	*/

	function notReady() {

		// If applet is not loaded, display an error

		if (!isLoaded()) {

			return true;

		}

		// If a printer hasn't been selected, display a message.

		else if (!qz.getPrinter()) {

			//alert('Printer '+document.getElementById('printer').value+' tidak ditemukan');
			alert('Printer pada '+printer+' tidak ditemukan');

			return true;

		}

		return false;

	}

	

	/**

	* Returns is the applet is not loaded properly

	*/

	function isLoaded() {

		if (!qz) {

			alert('Error:\n\n\tPrint plugin is NOT loaded!');

			return false;

		} else {

			try {

				if (!qz.isActive()) {

					alert('Error:\n\n\tPrint plugin is loaded but NOT active!');

					return false;

				}

			} catch (err) {

				alert('Error:\n\n\tPrint plugin is NOT loaded properly!'+err);

				return false;

			}

		}

		return true;

	}

	

	/**

	* Automatically gets called when "qz.print()" is finished.

	*/

	function qzDonePrinting() {

		// Alert error, if any

		if (qz.getException()) {

			alert('Error printing:\n\n\t' + qz.getException().getLocalizedMessage());

			qz.clearException();

			return; 

		}

		

		// Alert success message

		alert('Sukses Print pada '+printer);

	}