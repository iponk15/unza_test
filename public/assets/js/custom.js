$(document).on('click','.ajaxify',function(e){
    e.preventDefault();

    var ajaxify = [null, null, null];
    var url     = $(this).attr("href");
    var content = $('#body-content');
    var mnActve = 'menu-item-active';
    var mnCls   = $(this).attr('class');
    var clsOpen = 'menu-item-open';
    var clsExpn = '';
    var isActv  = $('.menu-item-active');

    if(mnCls.includes('menu-link')){
        $('li').removeClass(clsOpen);
        $('li').removeClass(clsExpn);
        $('li').removeClass(mnActve);

        $(this).parent().addClass(mnActve);
        $(this).parents('li.menu-item-submenu').addClass(clsOpen);
        $(this).parents('li.menu-item-parent').addClass(clsExpn);
        $(this).parents('li.menu-item-parent').addClass(clsOpen);
    }
    
    history.pushState(null, null, url);
    if(url != ajaxify[2]){
        ajaxify.push(url);
    }

    ajaxify = ajaxify.slice(-3, 5);

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    KTApp.block(content, {
        overlayColor : '#000000',
        state        : 'danger',
        message      : 'Please wait...'
    });

    var posting = $.get( url, { status_link: 'ajax' } );

    posting.done(function( data ) {
        // console.log(data);
        content.html(data);

        // set ubBlockui
        setTimeout(function() {
            KTApp.unblock(content);
        }, 2000);

        // set otomastis scroll top
        $('.scrolltop').trigger('click');
    });
});

$(window).bind('popstate',function(){
    var state       = window.location.href;
    var pageContent = $('#body-content');

    KTApp.block(pageContent, {
        overlayColor : '#000000',
        state        : 'danger',
        message      : 'Please wait...'
    });

    $.ajax({
        type     : "GET",
        cache    : false,
        url      : state,
        data     : { status_link: 'ajax' },
        dataType : "html",
        success  : function(res) {
            if (res == 'out') {
                window.location = route + 'home';
            } else {
                pageContent.html(res);
                $('.m-scroll-top').trigger('click');
            }

            setTimeout(function() {
                KTApp.unblock(pageContent);
            }, 2000);
        },
        error: function(xhr, ajaxOptions, thrownError) {
            errorAjaxify();
        }
    });
});

function ajaxProses(method, option, ele = null, eve = null){
    if(method == 'post'){
        // console.log(option.attr.route);
        if(option.type == 'swal'){
            swal.fire(option.attr).then(function(result){
                if (result.value) {
                    if(option.attrChild != undefined || option.attrChild != null){
                        Swal.fire(option.attrChild).then((result) => {
                            if (result.value) {
                                KTApp.block(option.blkUi, {
                                    overlayColor: '#000000',
                                    type: 'v2',
                                    state: 'success',
                                    message: 'Please wait...'
                                });

                                $.ajaxSetup({
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    }
                                });
                                
                                $.post(option.route, { note : result.value }, function(res){
                                    swal.fire(
                                        (res.status == 1) ? 'Berhasil' : 'Gagal' ,
                                        res.message,
                                        (res.status == 1) ? 'success' : 'error' 
                                    );

                                    if(res.status == 1){
                                        setTimeout(function() {
                                            KTApp.unblock(option.blkUi);
                                        }, 1000);
        
                                        $('.reload').trigger('click')
                                        $('.scrolltop').trigger('click');
                                    }else{
                                        $('.scrolltop').trigger('click');
                                        
                                        setTimeout(function() {
                                            KTApp.unblock(option.blkUi);
                                        }, 1000);
                                    }
                                }, 'json');
                            }
                        });
                    }else{
                        var param = {
                            route : option.route,
                            data  : option.data,
                            blkUi : option.blkUi,
                            type  : option.type
                        };
            
                        ajaxx(param);
                    }
                }
            });
        }else if(option.type == 'ajax'){
            var param = {
                route : option.route,
                data  : option.data,
                blkUi : option.blkUi,
                file  : option.file,
                type  : option.type,
                extn  : option.extn,
                html  : option.html,
                rnder : option.rnder
            };

            ajaxx(param);
        }
    }else if(method == 'get'){

    }
}

function ajaxx(param){
    if(param.html == undefined){
        KTApp.block(param.blkUi, {
            overlayColor: '#000000',
            type: 'v2',
            state: 'success',
            message: 'Please wait...'
        });
    }

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.post(param.route, param.data, function(res){
        if(param.html == true){
            $(param.rnder).html(res);
        }else{
            if(param.type == 'swal'){
                swal.fire(
                    (res.status == 1) ? 'Berhasil' : 'Gagal' ,
                    res.message,
                    (res.status == 1) ? 'success' : 'error' 
                );
            }

            setTimeout(function() {
                KTApp.unblock(param.blkUi);
            }, 1000);

            if(res.status == 1){
                if(param.file != undefined){
                    if(param.extn == 'pdf'){
                        var anchor      = document.createElement('a');
                        anchor.href     = param.file;
                        anchor.target   = '_blank';
                        anchor.download = 'users.pdf';
                        anchor.click();
                    }else{
                        window.location.href = param.file;
                    }
                }else{
                    $('.reload').trigger('click');
                }
            }

            $('.scrolltop').trigger('click');
        }
    }, (param.html == undefined) ? 'json' : 'html' );
}