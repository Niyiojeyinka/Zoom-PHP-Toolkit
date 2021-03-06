# Zoom-PHP-Toolkit

### Contents

<ul>
<li><a href="#about">About</a></li>
<li><a href="#req">Requirements</a></li>
<li><a href="#pub">Features</a></li>
<li><a href="#install">Installation</a></li>
<li><a href="#doc">Documentation</a></li>
<li><a href="#todo">Todo(s)</a></li>
<li><a href="#license">License</a></li>

</ul>

<br><br>

<div id="about">
<p> Zoom PHP API tool kit is PHP library that makes it easy to work with Zoom API v2 <p>
<p> it makes it easy to manage zoom functions like <code>User</code>  <code>Meeting</code> 
 <code>Webinar</code>   and more <br>
<b>Before you continue please readup on official zoom API documentation at <a href="https://marketplace.zoom.us/docs/api-reference/introduction">https://marketplace.zoom.us/docs/api-reference/introduction</a></b>
<br>
</div>

<div id="req">

### Requirements

<ul>
<li>PHP 5.6+</li>
<li>Zoom API key</li>
<li>Zoom Secret Key</li>
<li>Zoom user account email</li>

</ul>
<p>
To get your zoom keys register as a developer and create a jwt app on <a href="https://marketplace.zoom.us/develop/create?source=devdocs">Zoom marketplace</a>
</div>
<br>
<div id="install">
<ul>
<li>
Clone or Download the repo </li>
<li> Move the Zoom folder to your project</li>
<li>import the library

<li>

```php
require_once './Zoom/Index.php';
```

<li>go to the zoom/config.php directory
</li>

<li>Change the value of email,secret key and api key</li>
</div>

<br>

<div id="doc">

### Documentation

<div>
<b>Create a Meeting</b><br>
<p>
To ceate a meeting, check the example below 
</p>

```php
<?php
//Use case
use Zoom\Meeting;

$meeting = new Meeting();
//create a data meeting
$data = [
  'topic' => 'A new zoom meeting',
  'agenda' => 'our meeting desc',
  ...,
  'settings' => [
    'host_video' => false,
    'participant_video' => true,
    'join_before_host' => true,
    'audio' => true,
    'approval_type' => 2,
    'waiting_room' => false,
  ],
];
$meeting = $meeting->create($data);

?>
/*
this apply to all methods from this class

if successfull it returns response array
and if not it return false
and error details available on $meeting->zoomError variable


*/
```

<p>Please check the official docs for expected request data structure and response</p>

</div>
<div>
<b>Update a Meeting</b><br>

<p>
To edit a meeting, check the example below 
</p>

```php
<?php
//Use case
use Zoom\Meeting;

$meeting = new Meeting();
$data = [
  'topic' => 'A new zoom meeting',
  'agenda' => 'our meeting desc',
  ...,
  'settings' => [
    'host_video' => false,
    'participant_video' => true,
    'join_before_host' => true,
    'audio' => true,
    'approval_type' => 2,
    'waiting_room' => false,
  ],
];
$meeting_id ="meeting id";
$meeting = $meeting->update($data,$meeting_id);

?>
```

<p>Please check the official docs for expected request data structure and response</p>

</div>

<div>
<b>Delete a Meeting</b><br>

<p>
To delete a meeting, check the example below 
</p>

```php
<?php
//Use case
use Zoom\Meeting;

$meeting = new Meeting();

$meeting_id = 'meeting id';
$meeting = $meeting->delete($meeting_id);

?>
```

<p>Please check the official docs for expected request data structure and response</p>

</div>

<div>
<b>End a Meeting</b><br>

<p>
To end a meeting, check the example below 
</p>

```php
<?php
//Use case
use Zoom\Meeting;

$meeting = new Meeting();

$meeting_id = 'meeting id';
$meeting = $meeting->end($meeting_id);

?>
```

<p>Please check the official docs for expected  response structure</p>

</div>

<div>
<b>List  Meetings</b><br>

<p>
List all the meetings that were scheduled for a user (meeting host). 
</p>

```php
<?php
//Use case
use Zoom\Meeting;

$meeting = new Meeting();

$meeting = $meeting->list;

?>
```

<p>Please check the official docs for expected  response structure</p>

</div>

<!--parent div-->
</div>

Client Inspired by <a href="https://github.com/skwirrel/ZoomAPIWrapper">ZoomAPIWrapper</a>
<br>

<b>Work In Progress</b>
