function resetStylesByWindowSize() {
    // from CSS
    var headerHeight            = 40;
    var toolbarContainerHeight  = 90;
    var toolsHeight             = 31 + 2; // border
    var bottomContainerHeight   = 40;
    var contentExtensionsHeight = 68;
    
    
    var windowHeight  = $(window).height();
    var contentHeight = windowHeight - headerHeight;
    var objectsListContainerHeight = 
        contentHeight - toolbarContainerHeight - toolsHeight - bottomContainerHeight;
    var scopesSwitcherHeight = contentHeight - contentExtensionsHeight;


    $('<style type="text/css">'
        + '#content, #content > div, .sidebar-container, .shadow-container {height:' + contentHeight + 'px;}'
        + '.scopes-switcher {height:' + scopesSwitcherHeight + 'px;}'
        + '.objects-list-container {height:' + objectsListContainerHeight + 'px;}'
        + '</style>').appendTo("head");
}

function resizeElementsByWindowSize() {
    var headerHeight            = $('#header').height();
    var toolbarContainerHeight  = $('.toolbar-container').height();
    var toolsHeight             = $('.tools').height() + 2; // border
    var bottomContainerHeight   = $('.bottom-container').height();
    var contentExtensionsHeight = $('.content-extensions').height();
    
    
    var windowHeight  = $(window).height();
    var contentHeight = windowHeight - headerHeight;
    var objectsListContainerHeight = 
        contentHeight - toolbarContainerHeight - toolsHeight - bottomContainerHeight;
    var scopesSwitcherHeight = contentHeight - contentExtensionsHeight;

        
    $('#content, #content > div, .sidebar-container, .shadow-container').height(contentHeight);
    $('.scopes-switcher').height(scopesSwitcherHeight);
    $('.objects-list-container').height(objectsListContainerHeight);
}

resetStylesByWindowSize();
$(window).resize(resizeElementsByWindowSize);


$(function() {
    CurrentFolder.scopeSwitcher.initialize();
    CurrentFolder.toolbar.initialize();
    CurrentFolder.objectsList.initialize();
    
    $('.tools .select').change(CurrentFolder.objectsList.selectAllObjectsChange);
    $('.tools .copy').click(CurrentFolder.objectsList.copySelectedObject);
    $('.tools .paste').click(CurrentFolder.objectsList.pasteSelectedObject);
    //$('.tools .delete').click();
});


CurrentFolder.scopeSwitcher = new function() {
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

        var updateUrl  = Site.BASE_URL + '/folder/getUnimplementedEnvironment';
        var updateData = {
            folderId: CurrentFolder.ID,
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
        _self.scopes.foldersTree();
    };
    
    _self.scopes = {
        foldersTree: function() {
            var $item = $('.scopes-switcher .item[data-scope="foldersTree"]');

            var updateUrl  = Site.BASE_URL + '/folder/getFoldersTreeEnvironment';
            var updateData = {folderId: CurrentFolder.ID};
            var callback = function() {
                $('.folders-tree .hitarea').click(function() {
                    var $parent = $(this).parents('.item:eq(0)');

                    // open|close tree node
                    if ($(this).hasClass('closed')) {
                        $(this).removeClass('closed').addClass('opened');
                        $parent.find('.list:eq(0)').removeClass('closed').addClass('opened');
                    } else {
                        $(this).removeClass('opened').addClass('closed');
                        $parent.find('.hitarea').removeClass('opened').addClass('closed');
                        $parent.find('.list').removeClass('opened').addClass('closed');
                    }
                });
                    
                $('.folders-tree .item .title .label').contextPopup({
                    title: 'Folder',
                    items: [ 
                        { 
                            label: 'Create',
                            icon: Site.IMAGE_URL + '/icons/context/edit.png',
                            action: function(event) {
                                var folderId = $(event.currentTarget).parents('.item').attr('data-folder-id');
                                alert('Clicked on <<Create>>, on folder id: ' + folderId);
                            }
                        }, 
                        { 
                            label: 'Delete',
                            icon: Site.IMAGE_URL + '/icons/context/delete.png',
                            action: function(event) {
                                var folderId = $(event.currentTarget).parents('.item').attr('data-folder-id');
                                alert('Clicked on <<Delete>>, on folder id: ' + folderId);
                            }
                        },
                        // null can be used to add a separator to the menu items
                        null,
                        { 
                            label: 'Properties',
                            icon: Site.IMAGE_URL + '/icons/context/door.png',
                            action: function(event) {
                                var folderId = $(event.currentTarget).parents('.item').attr('data-folder-id');
                                alert('Clicked on <<Properties>>, on folder id: ' + folderId);
                            }
                        }
                    ]
                });
            };
            
            switchEnviroment($item, updateUrl, updateData, callback);
        },
        
        run: function() {
            var $item = $('.scopes-switcher .item[data-scope="run"]');
            unimplemented($item);
        },
        
        generalSearch: function() {
            var $item = $('.scopes-switcher .item[data-scope="generalSearch"]');
            unimplemented($item);
        },
        
        documentSearch: function() {
            var $item = $('.scopes-switcher .item[data-scope="documentSearch"]');
            unimplemented($item);
        },
        
        folderSearch: function() {
            var $item = $('.scopes-switcher .item[data-scope="folderSearch"]');
            unimplemented($item);
        }
    };
};


CurrentFolder.toolbar = new function() {
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
    
    _self.createTask = function() {
        $.jGrowl('Clicked on "Crează sarcină"');
    };
    
    _self.createDocument = function() {
        var $newDocumentContent = $('#new-document-content');
        $('#popup-template .template-content').html($newDocumentContent.html());
        $('#popup-template').show();
    };
    
    _self.createFolder = function() {
        $.jGrowl('Clicked on "Crează dosar"');
    };
};


CurrentFolder.objectsList = new function() {
    var _self = this;
    var _selectedObjectsIds = [];
    
    _self.pageIndex = 1;
    
    
    var removeFromArray = function(arr, elem) {
        return $.grep(arr, function(value) {
            return value != elem;
        });
    };
    
    var updateSelectedObjectsCounter = function() {
        var selectedObjectsCounter = _selectedObjectsIds.length 
                                   ? 'selectate: ' + _selectedObjectsIds.length 
                                   : '';
        $('.properties-container .selected-objects-counter').html(selectedObjectsCounter+'['+_selectedObjectsIds+']');
    };
    
    var checkPageObjectsSelected = function() {
        var totalObjectsCounter = $('.objects-list .item').length;
        var selectedObjectsCounter = $('.objects-list .item .chk input:checked').length;
        
        $('.tools .select').attr('checked', totalObjectsCounter == selectedObjectsCounter);
    };
    
    var updatePage = function(pageIndex) {
        pageIndex = pageIndex || _self.pageIndex;
        $.ajax({
            type: 'GET',
            url: CurrentFolder.UPDATE_URL + '?Document_page=' + pageIndex,
            success: function(content) {
                _self.update(content);
            }
        })
    };

    _self.initialize = function() {
        $('.objects-list .item').hover(
            function () {
                $('.status', this).css('visibility', 'visible');
                $('.context-menu', this).css('visibility', 'visible');
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
                $('.context-menu', this).css('visibility', 'hidden');
                if ( ! $('.icon .chk input', this).is(':checked')) {
                    $('.icon .chk', this).css('visibility', 'hidden');
                }

                var _this = this;
                clearTimeout($(this).data('timeout'));
                $('.actions', _this).animate({top:'0'});
                $('.info', _this).animate({top:'0'});
            }
        );

        $('.objects-list .item .chk input').change(_self.selectObjectChange);
        
        $('.objects-list .item').each(function(index, elem) {
            var $item = $(elem);
            
            $('.content .title a', $item).click(function() {_self.showPreview($item);return false;});
            $('.mark-unread', $item).click(function() {_self.markUnread($item);return false;});
            $('.delete-reference', $item).click(function() {_self.deleteReference($item);return false;});
            $('.copy-reference', $item).click(function() {_self.copyReference($item);return false;});
            $('.checkout', $item).click(function() {_self.checkoutObject($item);return false;});
            $('.checkin', $item).click(function() {_self.checkinObject($item);return false;});
        });
        

        $('.objects-list .item .context-menu').contextPopup({
            showOnLeftClick: true,
            items: [
                {
                    label: 'Deschide Cartela',
                    icon: Site.IMAGE_URL + '/icons/context/edit.png',
                    action: function(event) {
                        var $item = $(event.currentTarget).parents('.item');
                        location.href = $('.body .actions .open-card', $item).attr('href');
                    }
                },
                {
                    label: 'Marchează ca necitit',
                    icon: Site.IMAGE_URL + '/icons/context/delete.png',
                    action: function(event) {
                        var objectId = $(event.currentTarget).parents('.item').attr('data-object-id');
                        alert('Clicked on <<Marchează ca necitit>>, on object id: ' + objectId);
                    }
                },
                {
                    label: 'Salveaza local',
                    icon: Site.IMAGE_URL + '/icons/context/edit.png',
                    action: function(event) {
                        var $item = $(event.currentTarget).parents('.item');
                        _self.downloadObject($item);
                    }
                },
                // null can be used to add a separator to the menu items
                null,
                {
                    label: 'Properties',
                    icon: Site.IMAGE_URL + '/icons/context/door.png',
                    action: function(event) {
                        var objectId = $(event.currentTarget).parents('.item').attr('data-object-id');
                        alert('Clicked on <<Properties>>, on object id: ' + objectId);
                    }
                }
            ]
        });

        var $paginationContainer = $('.pagination-container');
        $('.yiiPager li', $paginationContainer).click(function() {
            var pageIndex = parseInt($(this).attr('data-page')) + 1;

            updatePage(pageIndex);
            _self.pageIndex = pageIndex;

            return false;
        });
    };
    
    _self.showPreview = function($item) {
        var objectId = $item.attr('data-object-id');
        var url = $('.content .title a', $item).attr('href');
        
        $('#popup-template .template-content').html('<iframe src="'+url+'" width="636" height="476" style="border:0;"></iframe>');
        $('#popup-template').show();
    };
    
    _self.markUnread = function($item) {
        var objectId = $item.attr('data-object-id');
        
        $.jGrowl('Marchează ca necitit, folder id: ' + CurrentFolder.ID + ', document id: ' + objectId);
    };
    
    _self.deleteReference = function($item) {
        var objectId = $item.attr('data-object-id');
        
        $.jGrowl('Şterge referinţă, folder id: ' + CurrentFolder.ID + ', document id: ' + objectId);
    };
    
    _self.copyReference = function($item) {
        var objectId = $item.attr('data-object-id');
        
        $.jGrowl('Copie referinţă, folder id: ' + CurrentFolder.ID + ', document id: ' + objectId);
    };
    
    _self.downloadObject = function($item) {
        var objectId = $item.attr('data-object-id');
        
        $('#helper-iframe').attr('src',  Site.BASE_URL + '/document/download/' + objectId);
    }
    
    _self.checkoutObject = function($item) {
        var objectId = $item.attr('data-object-id');
        
        $('#helper-iframe').attr('src',  Site.BASE_URL + '/document/checkout/' + objectId);
    };
    
    _self.checkinObject = function($item) {
        var objectId = $item.attr('data-object-id');

        var $newVersionContent = $('#new-version-content');
        $('#popup-template .template-content').html($newVersionContent.html());
        $('#popup-template .form input[type=hidden]').val(objectId);
        $('#popup-template').show();
    };
    
    _self.update = function(content) {
        var $content = $(content);

        $('.tools .count span').html($content.find('.tools .count span').html());
        $('.objects-list-container').html($content.find('.objects-list-container').html());
        $('.pagination-container').html($content.find('.pagination-container').html());

        _self.initialize();
        $('.objects-list .item').each(function(index, elem) {
            var objectId = $(elem).attr('data-object-id');
            
            if ($.inArray(objectId, _selectedObjectsIds) != -1) {
                var $chk = $('.chk', elem);
                $('input', $chk).attr('checked', true);
                $chk.css('visibility', 'visible');
            }
        });
        checkPageObjectsSelected();
    };
    
    _self.selectAllObjectsChange = function(eventObject) {
        var _this = eventObject.currentTarget;
        
        if ($(_this).is(':checked')) {
            $('.objects-list .item').each(function(index, elem) {
                var objectId = $(elem).attr('data-object-id');
                
                if ($.inArray(objectId, _selectedObjectsIds) == -1) {
                    _selectedObjectsIds.push(objectId);
                    
                    var $chk = $('.chk', elem);
                    $('input', $chk).attr('checked', true);
                    $chk.css('visibility', 'visible');
                }
            });
        } else {
            $('.objects-list .item').each(function(index, elem) {
                var objectId = $(elem).attr('data-object-id');
                
                _selectedObjectsIds = removeFromArray(_selectedObjectsIds, objectId);
                
                var $chk = $('.chk', elem);
                $('input', $chk).attr('checked', false);
                $chk.css('visibility', 'hidden');
            });
        }
        
        updateSelectedObjectsCounter();
    };
    
    _self.selectObjectChange = function(eventObject) {
        var _this = eventObject.currentTarget;
        var objectId = $(_this).parents('.item').attr('data-object-id');

        if ($(_this).is(':checked')) {
            if ($.inArray(objectId, _selectedObjectsIds) == -1) {
                _selectedObjectsIds.push(objectId);

                checkPageObjectsSelected();
            }
        } else {
            _selectedObjectsIds = removeFromArray(_selectedObjectsIds, objectId);

            $('.tools .select').attr('checked', false);
        }
        
        updateSelectedObjectsCounter();
    };
    
    _self.copySelectedObject = function() {
        $.cookie('selectedObjectsIds', _selectedObjectsIds, {path: '/'});
        
        $.jGrowl('Copied [' + _selectedObjectsIds + ']');
    };
    
    _self.pasteSelectedObject =  function() {
        var cookieSelectedObjectsIdsString = $.cookie('selectedObjectsIds');
        var cookieSelectedObjectsIds = cookieSelectedObjectsIdsString 
                                     ? cookieSelectedObjectsIdsString.split(',') 
                                     : [];
        
        if (cookieSelectedObjectsIds.length > 0) {
            $.ajax({
                type: 'POST',
                data: {folderId: CurrentFolder.ID, selectedObjectsIds: cookieSelectedObjectsIds},
                url: Site.BASE_URL + '/folder/addObjects',
                success: function() {
                    $.cookie('selectedObjectsIds', null, {path: '/'});
                    $.jGrowl('Pasted [' + cookieSelectedObjectsIds + ']');
                    
                    updatePage();
                }
            });
        } else {
            $.jGrowl('nu este copiat nimic');
        }
    };
};
