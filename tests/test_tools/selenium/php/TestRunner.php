
<html>

<head>
<HTA:APPLICATION ID="SeleniumHTARunner" APPLICATIONNAME="Selenium" >
<!-- the previous line is only relevant if you rename this
     file to "TestRunner.hta" -->

<!-- The copyright notice and other comments have been moved to after the HTA declaration,
     to work-around a bug in IE on Win2K whereby the HTA application doesn't function correctly -->
<!--
Copyright 2004 ThoughtWorks, Inc

 Licensed under the Apache License, Version 2.0 (the "License");
 you may not use this file except in compliance with the License.
 You may obtain a copy of the License at

     http://www.apache.org/licenses/LICENSE-2.0

 Unless required by applicable law or agreed to in writing, software
 distributed under the License is distributed on an "AS IS" BASIS,
 WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 See the License for the specific language governing permissions and
 limitations under the License.
-->
<meta content="text/html; charset=ISO-8859-1" http-equiv="content-type" />

<title>Selenium Functional Test Runner</title>
<link rel="stylesheet" type="text/css" href="<?php echo $base_dir; ?>core/selenium.css" />
<script language="JavaScript" type="text/javascript" src="<?php echo $base_dir; ?>core/scripts/selenium-browserdetect.js"></script>
<script language="JavaScript" type="text/javascript" src="<?php echo $base_dir; ?>core/scripts/selenium-browserbot.js"></script>
<script language="JavaScript" type="text/javascript" src="<?php echo $base_dir; ?>core/scripts/prototype-1.4.0.js"></script>
<script language="JavaScript" type="text/javascript" src="<?php echo $base_dir; ?>core/scripts/find_matching_child.js"></script>
<script language="JavaScript" type="text/javascript" src="<?php echo $base_dir; ?>core/scripts/selenium-api.js"></script>
<script language="JavaScript" type="text/javascript" src="<?php echo $base_dir; ?>core/scripts/selenium-commandhandlers.js"></script>
<script language="JavaScript" type="text/javascript" src="<?php echo $base_dir; ?>core/scripts/selenium-executionloop.js"></script>
<script language="JavaScript" type="text/javascript" src="<?php echo $base_dir; ?>core/scripts/selenium-testrunner.js"></script>
<script language="JavaScript" type="text/javascript" src="<?php echo $base_dir; ?>core/scripts/selenium-logging.js"></script>
<script language="JavaScript" type="text/javascript" src="<?php echo $base_dir; ?>core/scripts/selenium-version.js"></script>
<script language="JavaScript" type="text/javascript" src="<?php echo $base_dir; ?>core/scripts/htmlutils.js"></script>
<script language="JavaScript" type="text/javascript" src="<?php echo $base_dir; ?>core/xpath/misc.js"></script>
<script language="JavaScript" type="text/javascript" src="<?php echo $base_dir; ?>core/xpath/dom.js"></script>
<script language="JavaScript" type="text/javascript" src="<?php echo $base_dir; ?>core/xpath/xpath.js"></script>
<script language="JavaScript" type="text/javascript" src="<?php echo $base_dir; ?>prado-functional-test.js"></script>
<script language="JavaScript" type="text/javascript">
    function openDomViewer() {
        var autFrame = document.getElementById('myiframe');
        var autFrameDocument = getIframeDocument(autFrame);
        this.rootDocument = autFrameDocument;
        var domViewer = window.open('<?php echo $base_dir; ?>core/domviewer/domviewer.html');
        return false;
    }
	
	Logger.prototype.openLogWindow = function() 
	{
        this.logWindow = window.open(
            "<?php echo $base_dir; ?>core/SeleniumLog.html", "SeleniumLog",
            "width=600,height=250,bottom=0,right=0,status,scrollbars,resizable"
        );
        return this.logWindow;
    }

	var post_results_to = "<?php echo $driver; ?>";
	
</script>
</head>

<body onLoad="start();">

    <table class="layout">
    <form action="" name="controlPanel">

      <!-- Suite, Test, Control Panel -->

      <tr class="selenium">
        <td width="25%" height="30%" ><iframe name="testSuiteFrame" id="testSuiteFrame" src="<?php echo $driver; ?>?testSuites" application="yes"></iframe></td>
        <td width="50%" height="30%" ><iframe name="testFrame" id="testFrame" application="yes"></iframe></td>

		<td width="25%">        
		<table class="layout">
		  <tr class="selenium">
			<th width="25%" height="1" class="header">
			  <h3><a href="http://selenium.thoughtworks.com" title="The Selenium Project">Selenium</a></h3>
			</th>
		  </tr>
		  <tr>
			<td width="25%" height="30%" id="controlPanel">
	
			  <fieldset>
				<legend>Execute Tests</legend>
				
				<div>
				  <input id="modeRun" type="radio" name="runMode" value="0" checked="checked"/><label for="modeRun">Run</label>
				  <input id="modeWalk" type="radio" name="runMode" value="500" /><label for="modeWalk">Walk</label>
				  <input id="modeStep" type="radio" name="runMode" value="-1" /><label for="modeStep">Step</label>
				</div>
				
				<div>
				  <button type="button" id="runSuite" onClick="startTestSuite();"
						  title="Run the entire Test-Suite">
					<strong>All</strong>
				  </button>
				  <button type="button" id="runTest" onClick="runSingleTest();"
						  title="Run the current Test">
					<em>Selected</em>
				  </button>
				  <button type="button" id="continueTest" disabled="disabled"
						  title="Continue the Test">
					Continue
				  </button>
				</div>
				
			  </fieldset>
	
			  <table id="stats" align="center">
				<tr>
				  <td colspan="2" align="right">Elapsed:</td>
				  <td id="elapsedTime" colspan="2">00.00</td>
				</tr>
				<tr>
				  <th colspan="2">Tests</th>
				  <th colspan="2">Commands</th>
				</tr>
				<tr>
				  <td class="count" id="testRuns">0</td>
				  <td>run</td>
				  <td class="count" id="commandPasses">0</td>
				  <td>passed</td>
				</tr>
				<tr>
				  <td class="count" id="testFailures">0</td>
				  <td>failed</td>
				  <td class="count" id="commandFailures">0</td>
				  <td>failed</td>
				</tr>
				<tr>
				  <td colspan="2"></td>
				  <td class="count" id="commandErrors">0</td>
				  <td>incomplete</td>
				</tr>
			  </table>
	<!--
			  <fieldset>
				<legend>Tools</legend>
				<button type="button" id="domViewer1" onClick="openDomViewer();">
				  View DOM
				</button> 
				<button type="button" onClick="LOG.show();">
				  Show Log
				</button>
	
			  </fieldset>
	-->
			</td>
		  </tr>
		  </table>
		  </td>
	  </tr>

      <!-- AUT -->

      <tr>
        <td colspan="3" height="70%"><iframe name="myiframe" id="myiframe" src="<?php echo $base_dir; ?>core/TestRunner-splash.html"></iframe></td>
      </tr>
    </form>
    </table>

</body>
</html>