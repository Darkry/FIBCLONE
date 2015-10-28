<?php
// source: C:\xampp\htdocs\partyGame\app\presenters/templates/GamePrep/default.latte

class Template890a482ca366c42daaac0c003c674ada extends Latte\Template {
function render() {
foreach ($this->params as $__k => $__v) $$__k = $__v; unset($__k, $__v);
// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('5e918c97b5', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block content
//
if (!function_exists($_b->blocks['content'][] = '_lbc402d98810_content')) { function _lbc402d98810_content($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?><div class="cover-container">
  <h1>Hra <?php echo Latte\Runtime\Filters::escapeHtml($game->name, ENT_NOQUOTES) ?> se připravuje...</h1>
<br>
<div class="inner cover">
<h2>Přidat hráče</h2>
            <?php echo Nette\Bridges\FormsLatte\Runtime::renderFormBegin($form = $_form = $_control["addPlayerForm"], array()) ?>

            <p class="lead"><?php echo $_form["name"]->getControl()->addAttributes(array('class' => "form-control", 'placeholder' => "Název")) ?></p>
              <?php echo $_form["submit"]->getControl()->addAttributes(array('class' => "btn btn-default")) ?>

            <?php echo Nette\Bridges\FormsLatte\Runtime::renderFormEnd($_form) ?>

          </div>
<h2>Seznam hráčů</h2>
<button type="button" class="btn btn-default btn-lg active">Zahájit hru</button>
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