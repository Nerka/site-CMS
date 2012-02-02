dojo.provide('sitecms.PageCreationForm');

dojo.require('dijit._Widget');
dojo.require('dijit._Templated');

dojo.require('sitecms.TabContainer');
dojo.require('sitecms.PageForm');
dojo.require('sitecms.PageLine');

dojo.require('dijit.InlineEditBox');
dojo.require('dijit.layout.ContentPane');
dojo.require('dijit.form.Button');
dojo.require('dijit.DropDownMenu');
dojo.require('dijit.MenuItem');

dojo.declare('sitecms.PageCreationForm', [dijit._Widget, dijit._Templated], 
{
    templateString: dojo.cache("sitecms.PageCreationForm", "templates/PageCreationForm.html"),
    
    menu: null,
    languagesBar: [{id:'ru', 'title':'Rusian'}, {id:'it', 'title':'Italian'}, {id:'fr', 'title':'French'}, {id:'ge', 'title':'German'}, {id:'sp', 'title':'Spanish'}, {id:'pl', 'title':'Polish'}],
    defaultLanguages: [{id:'en', 'title':'English'}, {id:'lt', 'title':'Lithuanian'}],
    contentContainer: null,
    tabContainer: null,
    widgetsInTemplate: true,
    page: null,
    pageUrl: '/admin/page',
    publishtype: 'publish',
    type: 1,
    pageId: '',
    
    postCreate: function()
    {
        this.createTabContainer();
        this.createDropDownMenu();
        dojo.connect(this.pageNameNode, 'onChange', this, 'createPage');
    },
    
    createMenuItem: function(title, id)
    {
        var self = this;
        var menuItem = new dijit.MenuItem({
               label: title,
               onClick: function()
               {
                   self.createNewTab(title, id);
                   this.destroyRecursive();
               }
        });
        this.menu.addChild(menuItem);
    },
    
    createDropDownMenu:function()
    {
        this.menu = new dijit.DropDownMenu({style: "display: none;"});
        
        var self = this;
        dojo.forEach(this.languagesBar, function(language){
            self.createMenuItem(language.title, language.id);
        });
        
        var dropDownButton = new dijit.form.DropDownButton({
            label: "Add language",
            dropDown: self.menu
        });
        
        dojo.place(dropDownButton.domNode, this.pageNameNode.domNode, 'after');
    },
    
    createNewTab: function(title, content)
    {
        var self = this;
        var pageForm = new sitecms.PageForm();
        var newTab = new dijit.layout.ContentPane({
            title: title,
            content: pageForm,
            closable: true,
            onClose: function()
            {
                self.createMenuItem(title, content);
                return true;
            }
        });
        this.tabContainer.addChild(newTab);
    },
    
    createTabContainer:function()
    {
        this.tabContainer = new sitecms.TabContainer({
            doLayout:false,
            style:"min-height: 400px; width: 700px;"
        });
        
        var self = this;
        dojo.forEach(this.defaultLanguages, function(language){
            var pageForm = new sitecms.PageForm();
            var tab = new dijit.layout.ContentPane({
                title: language.title,
                content: pageForm
            });
            self.tabContainer.addChild(tab);
        });
        
        dojo.place(this.tabContainer.domNode, this.domNode, 'last');
        this.tabContainer.startup();  
    },
    
    createPage: function()
    {
        var self = this;
        dojo.xhrPost({
            url: '/admin/savepage',
            handleAs: 'json',
            content:
            {
                id: self.pageId,
                url: self.pageUrl,
                publishtype: self.publishtype,
                type: self.type,
                name: self.pageNameNode.get('value')
            },
            load:function(data)
            {
                if(data.pageId != null)
                {
                    self.pageId = data.pageId;
                    self.page = new sitecms.PageLine({pageData: data});
                    dojo.place(self.page.domNode, self.contentContainer.domNode, 'last');
                }
            }             
        });
    }
    
});