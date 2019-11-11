// window.addEventListener("load", function(){
//       // [1] GET ALL THE HTML ELEMENTS
//       var defualt_filter = 0;
//       var filters = [
//           'greyscale',
//           'sepia',
//           'blur',
//           'brightness',
//           'contrast',
//           'hue-rotate',
//           'hue-rotate2',
//           'hue-rotate3',
//           'saturate',
//           'invert',
//           'none'
//       ];
//       var video = document.getElementById("vid-show"),
//           canvas = document.getElementById("vid-canvas"),
//           take = document.getElementById("vid-take");
//           // filter = document.getElementById("filter-apply");
//         //  const apply = document.querySelector('#filter-apply');
//           //const take = document.querySelector('#filter-apply .vid-take');
//           //const video = document.querySelector('#filter-apply video');
  
    
//       // [2] ASK FOR USER PERMISSION TO ACCESS CAMERA
//       // WILL FAIL IF NO CAMERA IS ATTACHED TO COMPUTER
//       navigator.mediaDevices.getUserMedia({ video : true })
//       .then(function(stream) {
//         // [3] SHOW VIDEO STREAM ON VIDEO TAG
//         video.srcObject = stream;
//         video.play();
    
//         // [4] WHEN WE CLICK ON "TAKE PHOTO" BUTTON
//         take.addEventListener("click", function(){
//           // Create snapshot from video
//           var draw = document.createElement("canvas");
//           draw.width = video.videoWidth;
//           draw.height = video.videoHeight;
//           var context2D = draw.getContext("2d");
//           context2D.drawImage(video, 0, 0, video.videoWidth, video.videoHeight);
//           // Put into canvas container
//           canvas.innerHTML = "";
//           canvas.appendChild(draw);
//         });
//       })
//       .catch(function(err) {
//         document.getElementById("vid-controls").innerHTML = "Please enable access and attach a camera";
//       });
//       //Iterate through filters
//       // var effect = filters[defualt_filter++ % filters.length];
//       // if (effect)
//       // {
//       //     video.classList.add(effect);
//       //     canvas.classList.add(effect);
//       //     this.document.querySelector('.container h3').innerHTML = 'Current filter is: ' +effect;
//       // }
//       apply.onclick = video.onclick = function()
//       {
//         video.className = filters[defualt_filter++ % filters.length];
//       };
//     });
// (function() {
//   "use strict";

//   var video, $output;
//   var scale = 0.25;

//   var initialize = function() {
//       $output = $("#output");
//       video = $("#video").get(0);
//       $("#capture").click(captureImage);                
//   };

//   var captureImage = function() {
//       var canvas = document.createElement("canvas");
//       canvas.width = video.videoWidth * scale;
//       canvas.height = video.videoHeight * scale;
//       canvas.getContext('2d')
//             .drawImage(video, 0, 0, canvas.width, canvas.height);

//       var img = document.createElement("img");
//       img.src = canvas.toDataURL();
//       $output.prepend(img);
//   };

//   $(initialize);   
function capture() {
  var canvas = document.getElementById('canvas');     
  var video = document.getElementById('video');
  canvas.width = video.videoWidth;
  canvas.height = video.videoHeight;
  canvas.getContext('2d').drawImage(video, 0, 0, video.videoWidth, video.videoHeight);

  /** Code to merge image **/
  /** For instance, if I want to merge a play image on center of existing image **/
  const playImage = new Image();
  playImage.src = 'path to image asset';
  playImage.onload = () => {
    const startX = (video.videoWidth / 2) - (playImage.width / 2);
    const startY = (video.videoHeight / 2) - (playImage.height / 2);
    canvas.getContext('2d').drawImage(playImage, startX, startY, playImage.width, playImage.height);
    canvas.toBlob() = (blob) => {
      const img = new Image();
      img.src = window.URL.createObjectUrl(blob);
    };
  };
  /** End **/
}