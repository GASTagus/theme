  Genesis README.txt
		
		Genesis is a rapid development theme framework for Drupal 6. Genesis allows
		you to quickly build a sub-theme using preconfigured file structure, CSS
		layouts, grids and more.
		
		
		CREATE A NEW SUBTHEME
		
		To create your sub-theme first make a copy of the /genesis_SUBTHEME/ directory 
		and rename every instance of "SUBTHEME" to your theme name.
		
		The best place to save your new sub-theme is:
		  sites/all/themes/
				
		The new subtheme does not have to be inside the /genesis/ diretory, as this
		is optional in Drupal 6.
		
		The New Sub-theme Folder
		/genesis_SUBTHEME folder
		  Change "SUBTHEME" to your theme name e.g. /genesis_mytheme 
		
		The .info File
		/genesis_SUBTHEME/genesis_SUBTHEME.info
		  Change "SUBTHEME" to your theme name e.g genesis_mytheme.info
				Inside the .info file change:
				 1) the theme name
					2) the description
					3) change stylesheets[all][] = genesis_SUBTHEME.css to your theme name,
					   e.g stylesheets[all][] = genesis_mytheme.css
					
					DO NOT change the base theme!
		
		The CSS file
		/genesis_SUBTHEME/genesis_SUBTHEME.css
		  Change "SUBTHEME" to your theme name e.g genesis_mytheme.css. This is the 
				main CSS file for your theme and the one you will add the majority of your
				modifictions to.
		
		IE CSS
		/genesis_SUBTHEME/ie.css
		  Add your IE hacks to this file, but do not change what is already there!
				
				
	 LAYOUT - How to Change the Layout:

  Open these two files:
				/genesis/layout.css
		  /genesis_SUBTHEME/page.tpl.php
		  
				In layout.css you will find 7 preconfigured layouts to choose from. Take a look
				at that file now - there are visual comments that describe each layout.
				
				To change the layout select the ID selector that matches your preferred layout and 
				change the <body id="...."> in page.tpl.php
				
				By default this is <body id="genesis_1">. Save and upload the file and viola, the layout 
				will automagically change. 
				
				You can play around with this simply by changing the last character to a number between
				1 and 7, e.g genesis_2, genesis_3 etc.
				
				
		SUBTHEME PREPROCESS FUNCTIONS
				
		If you need to use a preprocess funtion open the template.php file
		in your new subtheme (one is included by default) and rename the function
		using your theme name e.g. mytheme_preprocess_page. This follows the standard
		Drupal convention of themeName_preprocess_hook.
		
		
		For extensive online help see the Genesis documentation:
		
		http://drupal.org/ (help pages under constuction)
		
		
		
		
		
		
		
		
		