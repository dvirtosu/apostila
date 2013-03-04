function resetStylesByWindowSize() {
    // from CSS
    var headerHeight  = 40;
    
    var windowHeight  = $(window).height();
    var contentHeight = windowHeight - headerHeight;

    $('<style type="text/css">'
        + '#content, #content > div, .sidebar-container, .shadow-container {height:' + contentHeight + 'px;}'
        + '</style>').appendTo("head");
}

function resizeElementsByWindowSize() {
    var headerHeight = $('#header').height();
    
    var windowHeight  = $(window).height();
    var contentHeight = windowHeight - headerHeight;
    
    $('#content, #content > div, .sidebar-container, .shadow-container').height(contentHeight);
}

resetStylesByWindowSize();
$(window).resize(resizeElementsByWindowSize);


$(function() {
    CurrentDocument.scopeSwitcher.initialize();
    CurrentDocument.toolbar.initialize();
});


CurrentDocument.scopeSwitcher = new function() {
    var _self = this;
    
    var switchUI = function($item) {
        $('.scopes-switcher .item.selected').removeClass('selected');
        $item.addClass('selected');
    };
    
    var updateEnviroment = function(scope, updateUrl, updateData, callback) {
        var $environment = $('.scope-environment > div[data-scope="'+scope+'"]');

        $.ajax({
            type: 'POST',
            url: updateUrl,
            data: updateData,
            beforeSend: function() {
                $('.scope-environment > div').hide();
                $environment.show();
            },
            success: function(msg) {
                $environment.html(msg);
                $environment.attr('data-status', 'loaded');

                callback();
            }
        });
    };
    
    var switchEnviroment = function($item, updateUrl, updateData, callback) {
        switchUI($item);

        var scope = $item.attr('data-scope');
        var $environment = $('.scope-environment > div[data-scope="'+scope+'"]');

        if ($environment.attr('data-status') == 'loaded') {
            $('.scope-environment > div').hide();
            $environment.show();
        } else {
            updateEnviroment(scope, updateUrl, updateData, callback);
        }
    };
    
    var unimplemented = function($item) {
        var scope = $item.attr('data-scope');

        var updateUrl  = Site.BASE_URL + '/' + CurrentDocument.ROUTE + '/getUnimplementedEnvironment';
        var updateData = {
            documentId: CurrentDocument.ID,
            scope: scope
        };
        var callback = function() {};
        
        switchEnviroment($item, updateUrl, updateData, callback);
    };
    
    _self.initialize = function() {
        $('.scopes-switcher .item').each(function() {
            var scope = $(this).attr('data-scope');
            $(this).click(_self.scopes[scope]);
        });

        // init default scope
        _self.scopes.documentCard();
    };
    
    _self.showPreview = function($item) {
        var versionId = $item.attr('data-version-id');
        var url = $('.content .title a', $item).attr('href');
        
        $('#popup-template .template-content').html('<iframe src="'+url+'" width="636" height="476" style="border:0;"></iframe>');
        $('#popup-template').show();
    };
    
    _self.markUnread = function($item) {
        var versionId = $item.attr('data-version-id');
        
        $.jGrowl('Marchează ca necitit, version id: ' + versionId);
    };
    
    _self.deleteVersion = function($item) {
        var versionId = $item.attr('data-version-id');
        
        $.ajax({
            type:"GET", 
            url: Site.BASE_URL + '/' + CurrentDocument.ROUTE + '/removeVersion/' + versionId,
            success: function(data) {
                $('.objects-list .item[data-version-id='+versionId+']').remove();
            }
        });
    };
    
    _self.scopes = {
        documentCard: function() {
            var $item = $('.scopes-switcher .item[data-scope="documentCard"]');
            
            var updateUrl  = Site.BASE_URL + '/' + CurrentDocument.ROUTE + '/getDocumentCard';
            var updateData = {documentId: CurrentDocument.ID};
            var callback = function() {};
            
            switchEnviroment($item, updateUrl, updateData, callback);
        },
        documentVersions: function() {
            var $item = $('.scopes-switcher .item[data-scope="documentVersions"]');
            
            var updateUrl  = Site.BASE_URL + '/' + CurrentDocument.ROUTE + '/getDocumentVersions';
            var updateData = {documentId: CurrentDocument.ID};
            var callback = function() {
                $('.objects-list .item').hover(
                    function () {
                        $('.status', this).css('visibility', 'visible');
                        $('.icon .chk', this).css('visibility', 'visible');

                        var _this = this;
                        var t = setTimeout(function() {
                            $('.info', _this).animate({top:'-16px'});
                            $('.actions', _this).animate({top:'-16px'});

                        }, 600);
                        $(this).data('timeout', t);
                    },
                    function () {
                        $('.status', this).css('visibility', 'hidden');
                        if ( ! $('.icon .chk input', this).is(':checked')) {
                            $('.icon .chk', this).css('visibility', 'hidden');
                        }

                        var _this = this;
                        clearTimeout($(this).data('timeout'));
                        $('.actions', _this).animate({top:'0'});
                        $('.info', _this).animate({top:'0'});
                    }
                );
                
                $('.objects-list .item').each(function(index, elem) {
                    var $item = $(elem);
                    
                    $('.content .title a', $item).click(function() {_self.showPreview($item);return false;});
                    $('.mark-unread', $item).click(function() {_self.markUnread($item);return false;});
                    $('.delete-version', $item).click(function() {_self.deleteVersion($item);return false;});
                });
                

                $('.objects-list .item .context-menu').contextPopup({
                    showOnLeftClick: true,
                    items: [
                        {
                            label: 'Marchează ca necitit',
                            icon: Site.IMAGE_URL + '/icons/context/delete.png',
                            action: function(event) {
                                var versionId = $(event.currentTarget).parents('.item').attr('data-version-id');
                                alert('Clicked on <<Marchează ca necitit>>, on version id: ' + versionId);
                            }
                        },
                        {
                            label: 'Salveaza local',
                            icon: Site.IMAGE_URL + '/icons/context/edit.png',
                            action: function(event) {
                                var versionId = $(event.currentTarget).parents('.item').attr('data-version-id');
        
                                $('#helper-iframe').attr('src', Site.BASE_URL + '/' + CurrentDocument.ROUTE +'/downloadversion/' + versionId);
                            }
                        },
                        // null can be used to add a separator to the menu items
                        null,
                        {
                            label: 'Properties',
                            icon: Site.IMAGE_URL + '/icons/context/door.png',
                            action: function(event) {
                                var versionId = $(event.currentTarget).parents('.item').attr('data-version-id');
                                alert('Clicked on <<Properties>>, on version id: ' + versionId);
                            }
                        }
                    ]
                });
            };
            
            switchEnviroment($item, updateUrl, updateData, callback);
        },
        documentRights: function() {
            var $item = $('.scopes-switcher .item[data-scope="documentRights"]');
            unimplemented($item);
        },
        documentSignInfo: function() {
            var $item = $('.scopes-switcher .item[data-scope="documentSignInfo"]');
            unimplemented($item);
        },
        documentBounds: function() {
            var $item = $('.scopes-switcher .item[data-scope="documentBounds"]');
            unimplemented($item);
        },
        documentHistory: function() {
            var $item = $('.scopes-switcher .item[data-scope="documentHistory"]');
            
            var updateUrl  = Site.BASE_URL + '/' + CurrentDocument.ROUTE + '/getDocumentHistory';
            var updateData = {documentId: CurrentDocument.ID};
            var callback = function() {};
            
            switchEnviroment($item, updateUrl, updateData, callback);
        }
    };
}

CurrentDocument.toolbar = new function() {
    var _self = this;
    
    _self.initialize = function() {
        $('.toolbar .item').click(function() {
            var action    = $(this).attr('data-action');
            var isEnabled = ! $(this).hasClass('disabled');

            if (isEnabled) {
                _self[action]();
            }
        });
    };
    
    _self.documentExport = function() {
        var objectId = CurrentDocument.OBJECT_ID;
        
        $('#helper-iframe').attr('src',  Site.BASE_URL + '/document/checkout/' + objectId);
        
        var $toolbar = $('.toolbar');
        $('.item[data-action="documentExport"]', $toolbar).addClass('disabled');
        $('.item[data-action="documentImport"]', $toolbar).removeClass('disabled');
    };
    
    _self.documentImport = function() {
        var objectId = CurrentDocument.OBJECT_ID;

        var $newVersionContent = $('#new-version-content');
        $('#popup-template .template-content').html($newVersionContent.html());
        $('#popup-template .form input[type=hidden]').val(objectId);
        $('#popup-template').show();
    };
    
    _self.documentLock = function() {
        $.jGrowl('Clicked on "Blochează"');
    };
    
    _self.documentSave = function() {
        $('#edit-card-form').submit();
    };
    
    _self.documentSaveAndClose = function() {
        $("#c-redirect").val(1);
        $('#edit-card-form').submit();
    };
    
    _self.documentSign = function() {
        $.jGrowl('Clicked on "Semnează"');
    };
    
    _self.documentSendAsAttachment = function() {
        $.jGrowl('Clicked on "Expediază ca ataşament"');
    };
};
