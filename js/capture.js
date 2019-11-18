    let width = 500,
    height = 0,
    filter = 'none',
    sticker = 'none',
    streaming = false;

  const video = document.getElementById('video');
  const canvas = document.getElementById('canvas');
  const capture = document.getElementById('capture');
  const thumbnail = document.getElementById('thumbnail');
  const addfilter = document.getElementById('filters');
  const clear = document.getElementById('clear');


  navigator.mediaDevices.getUserMedia({video: true, audio: false})

  .then(function(stream)
  {
   video.srcObject = stream;
   video.play();
  })
  .catch(function(err)
  {
    console.log('Error: ${err}');
  });

  video.addEventListener('canplay', function(e)
  {
    if(!streaming)
    {
      height = video.videoHeight / (video.videoWidth / width);

      video.setAttribute('width', width);
      video.setAttribute('height', height);
      canvas.setAttribute('width', width);
      canvas.setAttribute('height', height);

      streaming = true;
    }
  }, false)

  capture.addEventListener('click', function(e)
  {
    captureImage();
    e.preventDefault();
  }, false);


  function captureImage()
  {

    navigator.mediaDevices.getUserMedia({video: false, audio: false})
    const context = canvas.getContext('2d');

    if (width && height)
    {
      canvas.width = width;
      canvas.height = height;
      context.drawImage(video, 0, 0, width, height);


      const imgUrl = canvas.toDataURL('uploads/jpeg');
      console.log(imgUrl);
      const image = document.createElement('img');
      image.setAttribute('src', imgUrl);

      thumbnail.appendChild(image);

      var queryString = "?p=" + imgUrl;
 
      document.getElementById("url").value = imgUrl;


     // video.srcObject = stream;
      //video.pause();
    }
  }