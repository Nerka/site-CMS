dojo.provide('sitecms.PagesContainer');

dojo.require('dijit._Widget');
dojo.require('dijit._TemplatedMixin');


dojo.require('sitecms.PageLine');
dojo.require('sitecms.PageCreationForm');
dojo.require('sitecms.Dialog');

dojo.declare('sitecms.PagesContainer', [dijit._Widget, dijit._TemplatedMixin], 
{
    templateString: dojo.cache("sitecms.PagesContainer", "templates/PagesContainer.html"),
    
    pages: null,
    contentContainer: null,
    pageCreationForm: null,
    
    postCreate:function()
    {
       this.contentContainer = this.getParent();
       this.createPages();
       dojo.connect(this.createNewNode, 'onclick', this, 'toCreateNewPage');
    },
    
    createPages:function()
    {
        var self = this;
        dojo.forEach(this.pages, function(page){
            var pageLine = new sitecms.PageLine({
                pageData: page,
                contentContainer: self.contentContainer
            });
            dojo.place(pageLine.domNode, self.domNode, 'last')
        });
    },
    
    toCreateNewPage: function()
    {
        var dialogCMS = new sitecms.Dialog();
        this.createPageCreationForm();
        dialogCMS.setContent(this.pageCreationForm.domNode);
    },
    
    createDialog: function()
    {
        
    },
    
    createPageCreationForm:function()
    {
       this.pageCreationForm = new sitecms.PageCreationForm();
    }
});