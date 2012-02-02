dojo.provide('sitecms.PageForm');

dojo.require('dijit._Widget');
dojo.require('dijit._Templated');

dojo.require('dijit.Editor');
dojo.require('dijit.form.TextBox');

dojo.declare('sitecms.PageForm', [dijit._Widget, dijit._Templated], 
{
    templateString: dojo.cache("sitecms.PageForm", "templates/PageForm.html"),
    widgetsInTemplate: true,
    
    languageTitle: null,
    languageId: null,
    pageId: null,
    
    postCreate: function()
    {
        
    }
});