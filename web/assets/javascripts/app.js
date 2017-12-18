 $(document).foundation()

/*
	Inserts the last modified date and time.
*/
var modifiedDate = document.lastModified;
document.getElementById("last-modified").innerHTML = modifiedDate;

/*
Adds the Google translate element.
Modified from "Adding Google Translate to a web site" answer on stackoverflow by Robin Winslow accessed Nov. 15, 2017 (https://stackoverflow.com/questions/12243818/adding-google-translate-to-a-web-site)
*/
function googleTranslateElementInit() {
	new google.translate.TranslateElement({pageLanguage: 'en', layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');
}

/*
Popup confirmation when the "Delete Reader" button is clicked. Modified from https://sweetalert.js.org/guides/#advanced-examples.
*/
$("#btn-submit").on('click',function(e) {
  e.preventDefault();
  var form = $(this).parents('form.delete-reader');
  swal({
    title: "Delete Reader",
    text: "Are you sure you want to delete this reader?",
    icon: "warning",
    buttons: true,
    dangerMode: true,
  })
  .then((willDelete) => {
    if (willDelete) {
      form.submit();
    }
  }); 
})

/* 
Checks whether any readers have been added to the dropdown menu and calls emptyReadersAlert() if none have been. 
*/
function checkReaders() {
  list = document.getElementsByClassName("readers-list");
  if (list.length == 0) {
    emptyReadersAlert();
  }
}

/*
Displays an alert prompting the user to add a new reader. 
*/
function emptyReadersAlert() {
  swal("Add a new reader to continue.");
}

/*
Initiates Dynatable plug-in
*/
$(document).ready(function() {
  window.sessionTable = $('#session-table').dynatable();
});

/*
Takes a title and author and puts it into a string with a '+' in between each word.
Example catInfo("The Big Hill", "Ray Burns") returns "The+Big+Hill+Ray+Burns" 
*/
function catInfo(title, author) {
  var info = title + " " + author;
  var infoArray = info.split(" ");
  var catInfo = infoArray[0];

  for (i = 1; i < infoArray.length; i++) {
    catInfo = catInfo + "+" + infoArray[i];
  }
  return catInfo;
}

var title, author;

/*
Takes a book title and author and searches Google Books api.
*/
function getBookInfo(bookTitle, bookAuthor) {
  title = bookTitle;
  author = bookAuthor;
  var info = catInfo(bookTitle, bookAuthor);
  var s = document.createElement("script");
  s.src = "https://www.googleapis.com/books/v1/volumes?q=" + info + "&callback=handleResponse";
  document.body.appendChild(s);
}

/*
Takes the search result from getBookInfo() and displays certain information in a popup window.
*/
function handleResponse(response) {
  if (response.totalItems == 0) {
    noInfoAvailable();
  } else {
    var book = response.items[0];
    document.getElementById("book-title").innerHTML = book.volumeInfo.title;
    document.getElementById("book-image").src = book.volumeInfo.imageLinks.smallThumbnail;
    document.getElementById("book-author").innerHTML = "<b>Author(s): </b>" + book.volumeInfo.authors;
    document.getElementById("book-publisher").innerHTML = "<b>Publisher: </b>" + book.volumeInfo.publisher;
    document.getElementById("book-date").innerHTML = "<b>Published date: </b>" + book.volumeInfo.publishedDate;
    document.getElementById("book-description").innerHTML = book.volumeInfo.description;
    document.getElementById("book-page-count").innerHTML = "<b>Page count: </b>" + book.volumeInfo.pageCount;
    $('#info-modal').foundation('open');
  }
}

/*
Displays "No Info Available" in the popup form book info form.
*/
function noInfoAvailable() {
  document.getElementById("book-title").innerHTML = "No Info Available";
  document.getElementById("book-image").src = "";
  document.getElementById("book-author").innerHTML = "";
  document.getElementById("book-publisher").innerHTML = "";
  document.getElementById("book-date").innerHTML = "";
  document.getElementById("book-description").innerHTML = "";
  document.getElementById("book-page-count").innerHTML = "";
  $('#info-modal').foundation('open');
}

/*
Deletes a reading session when the "x" icon is clicked.
*/
$(function() {
  // $('.fa.fa-times-circle').click(function() {
  $('#session-table').on('click', '.fa.fa-times-circle', function() {
    var del_id = $(this).attr('id');
    var $ele = $(this).parent().parent();
    $.ajax({
      type: 'POST',
      url: '/~jessiekl/GetReadingTracker/reading_sessions/delete.php',
      data: {del_id:del_id},
      success: function(data){
        if(data=="YES") {
          $ele.fadeOut().remove();
          window.sessionTable.dom.update();
        } else {
          alert("Can't delete this session")
        }
      }
    })
  })
});

var readerid = $("#readerid").val();

$(document).ready(function() {
  $('#session-table-container').jtable({
    columnResizable: false,
    paging: true,
    pageSize: 10,
    sorting: true,
    defaultSorting: 'sessiondate ASC',
    gotoPageArea: 'none',

    actions: {
      listAction: '/~jessiekl/GetReadingTracker/reading_sessions/show.php',
      deleteAction: '/~jessiekl/GetReadingTracker/reading_sessions/delete.php'
    },
    fields: {
      id: {
        key: true,
        list: false
      },
      sessiondate: {
        title: 'Date',
        type: 'date',
        edit: 'false',
        width: '14%'
      },
      TestColumn: {
        sorting: false,
        width: '3%',
        display: function (data) {
        return "<i class='fa fa-external-link' onclick='getBookInfo(\"" + data.record.title + "\",\"" + data.record.author + "\")'/>";
        }
      },
      title: {
        title: 'Title',
        edit: 'false',
        width: '41%'
      },
      author: {
        title: 'Author',
        edit: 'false',
        width: '30%'
      },
      minutes: {
        title: 'Minutes',
        edit: 'false',
        width: '10%'
      },
      readerid: {
        list: false
      }
    }
  });
  $('#session-table-container').jtable('load', {readerid: readerid});
});

















