dojo.provide('sitecms.Dialog');

dojo.require('dijit.layout.ContentPane');
dojo.require('dijit._Widget');
dojo.require('dijit._Templated');

dojo.declare('sitecms.Dialog', [dijit._Widget, dijit._Templated], 
{
    templateString: dojo.cache("sitecms.Dialog", "templates/Dialog.html"),
    widgetsInTemplate: true,
    
    href:'',
    
    postCreate: function()
    {
        dojo.place(this.domNode, dojo.body());
        dojo.connect(this.overlay, 'onclick', this, 'destroyDialog');
    },
    
    setContentPaneHref: function()
    {
        this.contentPane.set('href', this.href);
    },
    
    destroyDialog:function()
    {
        this.destroyRecursive();
    },
    
    setContent: function(element)
    {
        dojo.place(element, this.contentPane.domNode, 'first');
    }
});