dojo.provide('sitecms.PageCreationForm');

dojo.require('dijit._Widget');
dojo.require('dijit._Templated');

dojo.require("dijit.layout.TabContainer");
dojo.require("dijit.layout.ContentPane");
dojo.require("dijit.form.Button");
dojo.require("dijit.DropDownMenu");
dojo.require("dijit.MenuItem");
dojo.require("dojo.parser");

dojo.declare('sitecms.PageCreationForm', [dijit._Widget, dijit._Templated], 
{
    templateString: dojo.cache("sitecms.PageCreationForm", "templates/PageCreationForm.html"),
    
    menu: null,
    languagesBar: [{id:'en', 'title':'English'}, {id:'lt', 'title':'Lithuanian'}, {id:'ru', 'title':'Rusian'}, {id:'sp', 'title':'Spanish'}, {id:'pl', 'title':'Polish'}],
    defaultLanguages: [{id:'en', 'title':'English'}, {id:'lt', 'title':'Lithuanian'}],
    tabContainer: null,
    widgetsInTemplate: true,
    
    postCreate: function()
    {
        this.createTabContainer();
        this.createDropDownMenu();
        
        this.tabContainer.layout();
    },
    
    createDropDownMenu:function()
    {
        this.menu = new dijit.DropDownMenu({style: "display: none;"});
        
        var self = this;
        dojo.forEach(this.languagesBar, function(language){ 
           var menuItem = new dijit.MenuItem({
               label: language.title
           });
           
           self.menu.addChild(menuItem);
        });
        
        var dropDownButton = new dijit.form.DropDownButton({
            label: "Add language",
            dropDown: self.menu
        });
        
        dojo.place(dropDownButton.domNode, this.domNode, 'first');
    },
    
    createTabContainer:function()
    {
        this.tabContainer = new dijit.layout.TabContainer({
            doLayout:false,
            style:"height: 200px; width: 340px;"
        });
        
        var self = this;
        
        dojo.forEach(this.defaultLanguages, function(language){
            var tab = new dijit.layout.ContentPane({
                title: language.title,
                id: language.id,
                content: 'No sub tabs'
            });
            self.tabContainer.addChild(tab);
        });
        
        dojo.place(this.tabContainer.domNode, this.domNode, 'last');
        this.tabContainer.startup();      
    }
    
});