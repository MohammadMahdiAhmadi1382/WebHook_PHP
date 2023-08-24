<?php
session_start();
$username=$_SESSION['username'];
$Comment=$_POST['comment'];
$Caption=$_POST['caption'];
$Name=$_POST['name'];
$Link=$_POST['link'];
$Src=$_POST['src'];


$webhookurl = " ... ";

$timestamp = date("c", strtotime("now"));

$json_data = json_encode([
    // Message
    "content" => $Comment,
    
    // Username
    "username" => $username,

    // Avatar URL.
    // Uncoment to replace image set in webhook
    //"avatar_url" => " AVATAR ",

    // Text-to-speech
    "tts" => false,

    // File upload
    // "file" => "",

    // Embeds Array
    "embeds" => [
        [
            // Embed Title
            "title" => $Caption,

            // Embed Type
            "type" => "rich",

            // Embed Description
            "description" => "دیدگاه کاربران",

            // URL of title link
            "url" => $Link,

            // Timestamp of embed must be formatted as ISO8601
            "timestamp" => $timestamp,

            // Embed left border color in HEX
            "color" => hexdec( "3366ff" ),

            // Footer
            "footer" => [
                "text" => " TEXT ",
                "icon_url" => " url shiftlearn"
            ],

            // Image to send
            "image" => [
                "url" => $Src
            ],

            // Thumbnail
            //"thumbnail" => [
            //    "url" => " Avatar"
            //],

            // Author
            //"author" => [
            //    "name" => "",
            //    "url" => ""
            //],

            // Additional Fields array
            //"fields" => [
            //    // Field 1
            //    [
            //        "name" => "Field #1 Name",
            //        "value" => "Field #1 Value",
            //        "inline" => false
            //    ],
            //    // Field 2
            //    [
            //        "name" => "Field #2 Name",
            //        "value" => "Field #2 Value",
            //        "inline" => true
            //    ]
            //    // Etc..
            //]
        ]
    ]

], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE );


$ch = curl_init( $webhookurl );
curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
curl_setopt( $ch, CURLOPT_POST, 1);
curl_setopt( $ch, CURLOPT_POSTFIELDS, $json_data);
curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt( $ch, CURLOPT_HEADER, 0);
curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);

if($response = curl_exec( $ch ))
{
      echo("No");
}
else
{
      echo("Send");
}
// If you need to debug, or find out why you can't send message uncomment line below, and execute script.
// echo $response;
curl_close( $ch );
