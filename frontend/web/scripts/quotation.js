(function () {
  var close, fab, fabCtr, links, nav, ripple;
  fab = document.querySelector('.fab');
  fabCtr = document.querySelector('.fab-ctr');
  nav = document.querySelector('.nav');
  links = document.querySelector('.links');
  close = document.querySelector('.close');
  ripple = document.querySelector('.ripple');
  fab.addEventListener('click', function () {
      fabCtr.classList.add('active');
      ripple.classList.add('off');
      setTimeout(function () {
          return nav.classList.add('active');
      }, 200);
      return setTimeout(function () {
          fab.classList.add('active');
          return links.classList.add('active');
      }, 150);
  });
  close.addEventListener('click', function () {
      links.classList.remove('active');
      fab.classList.remove('active');
      setTimeout(function () {
          return nav.classList.remove('active');
      }, 200);
      return setTimeout(function () {
          fabCtr.classList.remove('active');
          return ripple.classList.remove('off');
      }, 150);
  });
}.call(this));

$(document).ready(function() {
  $('#email').click(function() { email()  })
  $('#preview').click(function() { preview()  })
  $('#download').click(function() { download()  })
})


function preview() {
  console.log('loading preview')
  var pdf = new jsPDF('p','pt','a4')
  pdf.addHTML($("#quotation"), function() { pdf.output('dataurlnewwindow')  });
}

function download() {
  console.log('loading download')
  var pdf = new jsPDF('p','pt','a4')
  pdf.addHTML($("#quotation"), function() { pdf.save('quotation.pdf')  });
}

function email() {
  console.log('preparing email')
  var pdf = new jsPDF('p','pt','a4')
  pdf.addHTML($("#quotation"), function() {
    var pdfBase64 = pdf.output('datauristring')
    var url = "/frontend/web/index.php/site/emailquote";

    var blob = dataURItoBlob(pdfBase64);
    var fd = new FormData();
    fd.append('quote', blob);

    $.ajax({
      url: url,
      data: fd,
      type: 'POST',
      contentType: false,
      processData: false,
      success: function(data) {
        console.log(data);
      }
    });
  });
}

function dataURItoBlob(dataURI) {
    var binary = atob(dataURI.split(',')[1]);
    var array = [];
    for(var i = 0; i < binary.length; i++) {
        array.push(binary.charCodeAt(i));
    }
    return new Blob([new Uint8Array(array)], {type: 'image/jpeg'});
}
