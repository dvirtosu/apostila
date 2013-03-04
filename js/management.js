function resetStylesByWindowSize() {
    // from CSS
    var headerHeight            = 40;
    var toolbarContainerHeight  = 90;
    var toolsHeight             = 31 + 2; // border
    var bottomContainerHeight   = 40;
    var contentExtensionsHeight = 68;
    
    
    var windowHeight  = $(window).height();
    var contentHeight = windowHeight - headerHeight;
    var scopesSwitcherHeight = contentHeight - contentExtensionsHeight;


    $('<style type="text/css">'
        + '#content, #content > div, .sidebar-container, .shadow-container {height:' + contentHeight + 'px;}'
        + '.scopes-switcher {height:' + scopesSwitcherHeight + 'px;}'
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
    var scopesSwitcherHeight = contentHeight - contentExtensionsHeight;

        
    $('#content, #content > div, .sidebar-container, .shadow-container').height(contentHeight);
    $('.scopes-switcher').height(scopesSwitcherHeight);
}

resetStylesByWindowSize();
$(window).resize(resizeElementsByWindowSize);


$(function() {
    CurrentManagement.scopeSwitcher.initialize();
    CurrentManagement.toolbar.initialize();
});


CurrentManagement.scopeSwitcher = new function() {
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

        var updateUrl  = Site.BASE_URL + '/management/getUnimplementedEnvironment';
        var updateData = {
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
        _self.scopes.rights();
    };
    
    _self.scopes = {
        rights: function() {
            var $item = $('.scopes-switcher .item[data-scope="rights"]');
            unimplemented($item);
        },
        
        history: function() {
            var $item = $('.scopes-switcher .item[data-scope="history"]');
            unimplemented($item);
        }
    };
};


CurrentManagement.toolbar = new function() {
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
    
    _self.sign = function() {
        $.jGrowl('Clicked on "Semnează"');
    };
    
    _self.lock = function() {
        $.jGrowl('Clicked on "Blochează"');
    };
};
