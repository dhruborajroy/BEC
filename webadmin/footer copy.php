<!-- Footer Area Start Here -->
<footer class="footer-wrap-layout1">
    <div class="copyright">© Copyrights <a href="#">Barishal Engineering College Hall </a> 2018-<?php echo date('Y')?>.
        All
        rights reserved. Developed by <a href="https://dhruborajroy.github.io/myPortfollioWebsite">Dhrubo</a></div>
</footer>
<!-- Footer Area End Here -->
</div>
</div>
<!-- Page Area End Here -->
</div>
<!-- jquery-->
<script src="js/jquery-3.3.1.min.js"></script>
<!-- Plugins js -->
<script src="js/plugins.js"></script>
<!-- Popper js -->
<script src="js/popper.min.js"></script>
<!-- Bootstrap js -->
<script src="js/bootstrap.min.js"></script>
<!-- Counterup Js -->
<script src="js/jquery.counterup.min.js"></script>
<!-- Moment Js -->
<script src="js/moment.min.js"></script>
<!-- Waypoints Js -->
<script src="js/jquery.waypoints.min.js"></script>
<!-- Scroll Up Js -->
<script src="js/jquery.scrollUp.min.js"></script>
<!-- Full Calender Js -->
<script src="js/fullcalendar.min.js"></script>
<!-- Select 2 Js -->
<script src="js/select2.min.js"></script>
<!-- Date Picker Js -->
<script src="js/datepicker.min.js"></script>
<!-- Chart Js -->
<script src="js/Chart.min.js"></script>
<!-- Scroll Up Js -->
<script src="js/jquery.scrollUp.min.js"></script>
<!-- Data Table Js -->
<script src="js/jquery.dataTables.min.js"></script>
<!-- Vailidate Js -->
<script src="../assets/js/jquery.validate.js"></script>
<!-- Custom Js -->
<script src="js/toastr.min.js"></script>
<!-- sweet alert JS -->
<script src="../assets/js/sweetalert.min.js"></script>
<!-- Custom Js -->
<script src="js/main.js"></script>
<script src="js/custom.js"></script>

<script>
$(document).ready(function() {
    $('#summernote').summernote();
});
$(document).click(function(e) {
    var elem = $(".header-search-input");
    if (!elem.is(e.target) && elem.has(e.target).length === 0 && $('.header-search-input:focus').length === 0) {
        $(".header-search-results").hide();
    }
});
$('.header-search-input').on('focus', function() {
    if ($('.header-search-results li').length > 0) {
        $('.header-search-results').show();
    }
});
$(document).on('click', 'li.user', function(e) {
    e.preventDefault();
    window.location.href = $(this).attr('data-url');
});
$(document).on('click', 'li.book', function(e) {
    e.preventDefault();
    window.location.href = $(this).attr('data-url');
});

function userTemplate(user) {
    var url = '/admin/user/[userId]/edit';
    var template = '<li class="flex-row d-flex user" data-url="' + url.replace("[userId]", user.id) + '">';
    template += '<div class="user-meta">';
    template += '<h4><strong>#' + user.id + '</strong> ' + user.firstName + ' ' + user.lastName + ' ';
    if (user.role) {
        template += '<span>(' + user.role.name + ')</span>';
    }
    template += '</h4>';
    template += "<div><strong>Email:</strong> " + user.email + "</div>";
    template += '</div>';
    template += '</li>';
    return template;
}

function bookTemplate(book) {
    var url = '/admin/book/[bookId]/edit';
    var i, lastIndex, template = '<li class="flex-row d-flex book" data-url="' + url.replace("[bookId]", book.id) +
        '">';
    template += '<div class="book-cover">';
    if (book.cover) {
        template += '<img src="' + book.cover.webPath + '" class="img-fluid">';
    } else {
        template += '<img src="/resources/images/comingsoon.png" class="img-fluid">';
    }
    template += '</div>';
    template += '<div class="book-meta">';
    template += '<h4>' + book.title + '';
    if (book.publishingYear) {
        template += ' <span>(' + book.publishingYear + ')</span>';
    }
    template += '</h4>';

    if (book.publisher) {
        template += "<div><strong>Publisher:</strong> " + book.publisher.name + "</div>";
    }
    if (book.ISBN13) {
        template += "<div><strong>ISBN13:</strong> " + book.ISBN13 + "</div>";
    } else if (book.ISBN10) {
        template += "<div><strong>ISBN10:</strong> " + book.ISBN10 + "</div>";
    }
    if (book.genres != null && book.genres.length > 0) {
        template += "<div><strong>Genres:</strong> ";
        lastIndex = book.genres.length - 1;
        for (i = 0; i < book.genres.length; i++) {
            template += book.genres[i].name;
            if (lastIndex != i) {
                template += ", ";
            }
        }
        template += "</div>";
    }
    if (book.authors != null && book.authors.length > 0) {
        template += "<div><strong>Authors:</strong> ";
        lastIndex = book.authors.length - 1;
        for (i = 0; i < book.authors.length; i++) {
            if (book.authors[i].firstName) {
                var text = book.authors[i].firstName + ' ' + book.authors[i].lastName;
            } else {
                text = book.authors[i].lastName;
            }
            template += text;
            if (lastIndex != i) {
                template += ", ";
            }
        }
        template += "</div>";
    }
    template += '</div>';
    template += '</li>';
    return template;
}
</script>

<script>
$(document).ready(function() {

    var bookGoogleSearchByIsbnPublicUrl = '/book/google-search-by-isbn';
    var bookByGoogleDataGetUrl = '/google-book/[googleBookId]/get';
    $(document).on('click', '.select-book-by-isbn', function(e) {
        e.preventDefault();
        var googleBookId = $(this).attr('data-id');
        $.ajax({
            dataType: 'json',
            method: 'POST',
            url: bookByGoogleDataGetUrl.replace('[googleBookId]', googleBookId),
            beforeSend: function(data) {
                app.card.loading.start('.result-books-by-isbn');
            },
            success: function(data) {
                if (data.redirect) {
                    window.location.href = data.redirect;
                } else {
                    if (data.error) {
                        app.notification('error', data.error);
                    } else {
                        app.notification('success', data.success);
                        app.notification('success',
                            'Please don\'t forget to save the book');

                        $('#book-search-by-isbn-modal').modal('hide');
                        if (data.book.title) {
                            $('.book-field-title').val(data.book.title);
                        }
                        if (data.book.publishingYear) {
                            $('.book-field-publishing-year').val(data.book.publishingYear);
                        }
                        if (data.book.ISBN10) {
                            $('.book-field-isbn10').val(data.book.ISBN10);
                        }
                        if (data.book.ISBN13) {
                            $('.book-field-isbn13').val(data.book.ISBN13);
                        }
                        if (data.book.pages) {
                            $('.book-field-pages').val(data.book.pages);
                        }
                        if (data.book.description) {
                            $('#content-box').summernote('code', data.book.description);
                        }
                        if (data.book.language) {
                            $('.book-field-lang').val(data.book.language);
                        }
                        if (data.book.publisher) {
                            var publisher = new Option(data.book.publisher.name, data.book
                                .publisher.id, true, true);
                            $('#publisherId').val(null).append(publisher).trigger('change');
                        }
                        if (data.book.authors) {
                            $('#authors').val(null);
                            for (var i = 0; i < data.book.authors.length; i++) {
                                var item = data.book.authors[i];
                                var insertData = {
                                    id: item.id,
                                    text: item.lastName
                                };
                                var author = new Option(insertData.text, insertData.id,
                                    false, true);
                                $('#authors').append(author).trigger('change');
                            }
                        }
                        if (data.book.coverId && data.cover) {
                            $('.coverId').val(data.book.coverId);
                            var coverDropzone = $('.cover-drop-zone');
                            if ($(coverDropzone).hasClass('cover-exist')) {
                                $(coverDropzone).find('img').remove();
                                $(coverDropzone).append('<img src="' + data.cover.webPath +
                                    '" class="img-fluid">');
                            } else {
                                $(coverDropzone).addClass('cover-exist').find(
                                    '.remove-book-cover').removeClass('d-none');
                                $(coverDropzone).append('<img src="' + data.cover.webPath +
                                    '" class="img-fluid">');
                            }
                        }
                    }
                }
            },
            error: function(jqXHR, exception) {
                app.notification('error', app.getErrorMessage(jqXHR, exception));
            },
            complete: function(data) {
                app.card.loading.finish('.result-books-by-isbn');
            }
        });
    });
    $('.search-by-isbn').on('click', function(e) {
        e.preventDefault();
        var container = $('#result-books-by-isbn');
        if ($('.isbn-code-13').val()) {
            $.ajax({
                dataType: 'json',
                method: 'POST',
                data: 'searchText=' + $('.isbn-code-13').val(),
                url: bookGoogleSearchByIsbnPublicUrl,
                beforeSend: function(data) {
                    $('#book-search-by-isbn-modal').modal('show');
                    app.card.loading.start('.result-books-by-isbn');
                },
                success: function(data) {
                    if (data.redirect) {
                        window.location.href = data.redirect;
                    } else {
                        if (data.error) {
                            app.notification('error', data.error);
                        } else {
                            var books = $.parseJSON(data.books);
                            $(container).mCustomScrollbar('destroy');
                            $(container).html('');
                            if (books.items) {
                                for (var i = 0; i < books.items.length; i++) {
                                    var item = books.items[i];
                                    $('#result-books-by-isbn').append(formatBook(item));
                                }
                            } else {
                                app.notification('information',
                                    'Nothing found (Make sure Google API setting is correct)'
                                );
                                $('#book-search-by-isbn-modal').modal('hide');
                            }
                            $(container).mCustomScrollbar({
                                setHeight: '100%',
                                axis: "y",
                                autoHideScrollbar: true,
                                scrollInertia: 200,
                                advanced: {
                                    autoScrollOnFocus: false
                                }
                            });
                        }
                    }
                },
                error: function(jqXHR, exception) {
                    app.notification('error', app.getErrorMessage(jqXHR, exception));
                },
                complete: function(data) {
                    app.card.loading.finish('.result-books-by-isbn');
                }
            });
        } else {
            app.notification('information', 'ISBN is required.');
        }
    });

    var authorSearchUrl = 'ajax/request.php';
    $("#authors").select2({
        ajax: {
            url: authorSearchUrl,
            dataType: 'json',
            type: 'POST',
            data: function(params) {
                return {
                    searchText: params.term
                };
            },
            processResults: function(data, params) {
                if (data.redirect) {
                    window.location.href = data.redirect;
                } else {
                    if (data.error) {
                        app.notification('error', data.error);
                    } else {
                        return {
                            results: $.map(data, function(item) {
                                if (item.firstName && item.lastName) {
                                    var text = item.firstName + ' ' + item.lastName;
                                } else if (item.firstName) {
                                    text = item.firstName;
                                } else if (item.lastName) {
                                    text = item.lastName;
                                }
                                return {
                                    text: text,
                                    id: item.id,
                                    term: params.term
                                }
                            })
                        };
                    }
                }
            },
            cache: false
        },
        templateResult: function(item) {
            if (item.loading) {
                return item.text;
            }
            return app.markMatch(item.text, item.term);
        },
        minimumInputLength: 2
    });
    // Publisher Ajax starts here
    var publisherSearchUrl = 'ajax/request.php';
    $('#publisherId').select2({
        ajax: {
            url: function() {
                return publisherSearchUrl;
            },
            dataType: 'json',
            type: 'POST',
            data: function(params) {
                return {
                    searchText: params.term
                };
            },
            processResults: function(data, params) {
                if (data.redirect) {
                    window.location.href = data.redirect;
                } else {
                    if (data.error) {
                        app.notification('error', data.error);
                    } else {
                        return {
                            results: $.map(data, function(item) {
                                return {
                                    text: item.name,
                                    id: item.id,
                                    term: params.term
                                }
                            })
                        };
                    }
                }
            },
            cache: true
        },
        templateResult: function(item) {
            if (item.loading) {
                return item.text;
            }
            return app.markMatch(item.text, item.term);
        },
        minimumInputLength: 2
    });

    // Publisher Ajax ends here


    // required part 
    $('.validate').validate({
        errorPlacement: function(error, element) {
            if (element != undefined) {
                $(element).tooltipster('update', $(error).text());
                $(element).tooltipster('show');
            }
        },
        success: function(label, element) {
            $(element).tooltipster('hide');
        },
        messages: {
            url: {
                remote: jQuery.validator.format(
                    "<strong>{0}</strong> is already exist. Please use another URL.")
            }
        },
        rules: {
            title: {
                required: true
            },
            pages: {
                number: true
            },
            price: {
                number: true
            },
            publishingYear: {
                number: true
            },
            ISBN10: {
                digits: true,
                maxlength: 10,
                minlength: 10
            },
            ISBN13: {
                digits: true,
                maxlength: 13,
                minlength: 13
            }
        }
    });

});
</script>
</body>

</html>