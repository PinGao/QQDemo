<?php
	namespace PHPSTORM_META {
	/** @noinspection PhpUnusedLocalVariableInspection */
	/** @noinspection PhpIllegalArrayKeyTypeInspection */
	$STATIC_METHOD_TYPES = [

		\D('') => [
			'Adv' instanceof Think\Model\AdvModel,
			'Mongo' instanceof Think\Model\MongoModel,
			'View' instanceof Think\Model\ViewModel,
			'Relation' instanceof Think\Model\RelationModel,
			'Fr' instanceof Home\Model\Friends,
			'Co' instanceof Home\Model\Content,
			'Merge' instanceof Think\Model\MergeModel,
			'' instanceof Home\Model\Users,
		],
	];
}