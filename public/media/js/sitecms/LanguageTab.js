dojo.provide('sitecms.LanguageTab');

dojo.require('dijit.layout.ContentPane');

dojo.declare('sitecms.LanguageTab', dijit.layout.ContentPane, 
{
    
    laguageId: null,
    
    postCreate: function()
    {
        
    },
    
    getLanguageId: function()
    {
        return this.laguageId;
    }

});