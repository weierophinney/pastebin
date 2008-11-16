<?php
class My_Form_Decorator_OnSubmit extends Zend_Form_Decorator_Abstract
{
    public function render($content)
    {
        $form = $this->getElement();
        $id   = $form->getId();
        $callback = (strstr($id, 'followup')) ? 'processFollowupForm' : 'processNewForm';
        $onSubmit =<<<EOH
<script type="dojo/method">
    var form = dijit.byId("$id");
    var url  = form.attr("action");
    form.attr("action", "#");
    form.attr("url", url);
    dojo.connect(form, "onSubmit", paste, "$callback");
</script>
EOH;
        return $content . $onSubmit;
    }
}
