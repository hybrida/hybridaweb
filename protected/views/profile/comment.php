<? $this->pageTitle = "Kommentarer" ?>
<? $this->renderPartial('_header', array(
	'user' => $user,
))?>

<? $this->widget('comment.components.commentWidget',array(
	'id' => $user->id,
	'type' => 'profile',
)) ?>