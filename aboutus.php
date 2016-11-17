<?php 
//Author: Sebastian Richters, David Han, Andrew Crues
//Assignment 2
//COMP 3512 Fall 2016 

//--------About Us PHP Page----------
include './inc/header.inc.php';?>

<div class="ui hidden divider"></div>
<div class="ui grid">
  <div class="seven wide centered column">
<div class="ui message">
  <div class="header">
	<h5><i> NOTE: This site is hypothetical and was created as a term project for COMP 3512 at Mount Royal University taught by Randy Connolly.</i></h5>
  <br>
  </div>
  <div class="header">
    Project Information
  </div>
  <ul class="list">
    <li>Mount Royal University: BCIS Program</li>
    <li>COMP3512 Web Development II - Fall 2016</li>
	<li>Delivered on November 19th, 2016</li>
	</ul>
	<div class="ui hidden divider"></div>
	<div class="header">
    Material Used
  </div>
  <ul class="list">
    <li><a href="http://semantic-ui.com/">Semantic UI</a></li>
	<li>JavaScript</li>
	<li>PHP Sessions</li>
	</ul>
	<table class="ui celled striped table">
  <thead>
    <tr><th colspan="2">
      Team Members and Responsibilities
    </th>
  </tr></thead>
  <tbody>
    <tr>
      <td class="collapsing">
        <i class="user icon"></i> Andrew Cruess
      </td>
      <td><ul><li>Search Functionality</li><li>Browse Galleries</li><li>Single Gallery</li><li>Update Old Pages</li><li>Google Maps Integration</li><li>Testing & Refinement for Delivery</li>
	  </ul></td>
      
    </tr>
    <tr>
      <td class="collapsing">
        <i class="user icon"></i> Sebastian Richters
      </td>
      <td><ul><li>Data Access Layer</li><li>Cart Integration & Functionality</li><li>Single Subject</li><li>Browse Subjects</li><li>Retrofitting data access layer into old pages</li>
	  </ul></td>
      
    </tr>
    <tr>
      <td class="collapsing">
        <i class="user icon"></i> David Han
      </td>
      <td><ul><li>Session State Functionality</li><li>Favorites Integration & Functionality</li><li>Cart Integration</li><li>Fixing Semantic UI Issues</li>
	  </ul></td>
      
    </tr>
    
  </tbody>
</table>
</div>
</div>
</div>

<?php include "./inc/footer.inc.php"; ?>