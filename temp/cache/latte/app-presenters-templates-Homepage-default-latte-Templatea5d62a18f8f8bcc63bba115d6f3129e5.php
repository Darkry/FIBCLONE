<?php
// source: C:\xampp\htdocs\partyGame\app\presenters/templates/Homepage/default.latte

class Templatea5d62a18f8f8bcc63bba115d6f3129e5 extends Latte\Template {
function render() {
foreach ($this->params as $__k => $__v) $$__k = $__v; unset($__k, $__v);
// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('64410f4c22', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block content
//
if (!function_exists($_b->blocks['content'][] = '_lb8041b7f882_content')) { function _lb8041b7f882_content($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?><div class="cover-container">

          <div class="masthead clearfix">
            <div class="inner">
              <h3 class="masthead-brand">Clonfib</h3>
                          </div>
          </div>

          <div class="inner cover">
            <h1 class="cover-heading">Nová hra</h1>
            <?php echo Nette\Bridges\FormsLatte\Runtime::renderFormBegin($form = $_form = $_control["addGameForm"], array()) ?>

            <p class="lead"><?php echo $_form["name"]->getControl()->addAttributes(array('class' => "form-control", 'placeholder' => "Název")) ?></p>
            <p class="lead">
              <?php echo $_form["submit"]->getControl()->addAttributes(array('class' => "btn btn-lg btn-default")) ?>

            </p>
            <?php echo Nette\Bridges\FormsLatte\Runtime::renderFormEnd($_form) ?>

          </div>

          <div class="inner cover"><br>
            <h2 class="cover-heading">Seznam her</h1>
            <ul class="list-unstyled">
<?php $iterations = 0; foreach ($games as $game) { ?>              <li><a href=""><?php echo Latte\Runtime\Filters::escapeHtml($game->name, ENT_NOQUOTES) ?></a></li>
<?php $iterations++; } ?>
            </ul>
          </div>

          <div class="mastfoot">
            <div class="inner">
              <p>Cover template for <a href="http://getbootstrap.com">Bootstrap</a>, by <a href="https://twitter.com/mdo">@mdo</a>.</p>
            </div>
          </div>

</div><?php
}}

//
// end of blocks
//

// template extending

$_l->extends = empty($_g->extended) && isset($_control) && $_control instanceof Nette\Application\UI\Presenter ? $_control->findLayoutTemplateFile() : NULL; $_g->extended = TRUE;

if ($_l->extends) { ob_start();}

// prolog Nette\Bridges\ApplicationLatte\UIMacros

// snippets support
if (empty($_l->extends) && !empty($_control->snippetMode)) {
	return Nette\Bridges\ApplicationLatte\UIRuntime::renderSnippets($_control, $_b, get_defined_vars());
}

//
// main template
//
if ($_l->extends) { ob_end_clean(); return $template->renderChildTemplate($_l->extends, get_defined_vars()); }
call_user_func(reset($_b->blocks['content']), $_b, get_defined_vars()) ; 
}}