<?php
return array(
    'zf-mvc-auth' => array(
        'authorization' => array(),
    ),
    'controllers' => array(
        'factories' => array(),
    ),
    'router' => array(
        'routes' => array(
            'dcm.rest.competition' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/group/:group_id/competition[/:competition_id]',
                    'defaults' => array(
                        'controller' => 'DCM\\V1\\Rest\\Competition\\Controller',
                    ),
                ),
            ),
            'dcm.rest.user' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/user[/:user_id]',
                    'defaults' => array(
                        'controller' => 'DCM\\V1\\Rest\\User\\Controller',
                    ),
                ),
            ),
            'dcm.rest.competition-group' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/group[/:group_id]',
                    'defaults' => array(
                        'controller' => 'DCM\\V1\\Rest\\CompetitionGroup\\Controller',
                    ),
                ),
            ),
            'dcm.rest.competition-participant' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/group/:group_id/competition/:competition_id/participant[/:participant_id]',
                    'defaults' => array(
                        'controller' => 'DCM\\V1\\Rest\\CompetitionParticipant\\Controller',
                    ),
                ),
            ),
            'dcm.rest.competition-rating-criterion' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/group/:group_id/criterion[/:criterion_id]',
                    'defaults' => array(
                        'controller' => 'DCM\\V1\\Rest\\CompetitionRatingCriterion\\Controller',
                    ),
                ),
            ),
            'dcm.rest.competition-rating' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/group/:group_id/competition/:competition_id/participant/:participant_id/rating[/:rating_id]',
                    'defaults' => array(
                        'controller' => 'DCM\\V1\\Rest\\CompetitionRating\\Controller',
                    ),
                ),
            ),
        ),
    ),
    'zf-versioning' => array(
        'uri' => array(
            1 => 'dcm.rest.competition',
            3 => 'dcm.rest.user',
            4 => 'dcm.rest.competition-group',
            5 => 'dcm.rest.competition-participant',
            0 => 'dcm.rest.competition-rating-criterion',
            6 => 'dcm.rest.competition-rating',
        ),
    ),
    'zf-rpc' => array(),
    'zf-content-negotiation' => array(
        'controllers' => array(
            'DCM\\V1\\Rest\\Competition\\Controller' => 'HalJson',
            'DCM\\V1\\Rest\\User\\Controller' => 'HalJson',
            'DCM\\V1\\Rest\\CompetitionGroup\\Controller' => 'HalJson',
            'DCM\\V1\\Rest\\CompetitionParticipant\\Controller' => 'HalJson',
            'DCM\\V1\\Rest\\CompetitionRatingCriterion\\Controller' => 'HalJson',
            'DCM\\V1\\Rest\\CompetitionRating\\Controller' => 'HalJson',
        ),
        'accept_whitelist' => array(
            'DCM\\V1\\Rest\\Competition\\Controller' => array(
                0 => 'application/vnd.dcm.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ),
            'DCM\\V1\\Rest\\User\\Controller' => array(
                0 => 'application/vnd.dcm.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ),
            'DCM\\V1\\Rest\\CompetitionGroup\\Controller' => array(
                0 => 'application/vnd.dcm.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ),
            'DCM\\V1\\Rest\\CompetitionParticipant\\Controller' => array(
                0 => 'application/vnd.dcm.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ),
            'DCM\\V1\\Rest\\CompetitionRatingCriterion\\Controller' => array(
                0 => 'application/vnd.dcm.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ),
            'DCM\\V1\\Rest\\CompetitionRating\\Controller' => array(
                0 => 'application/vnd.dcm.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ),
        ),
        'content_type_whitelist' => array(
            'DCM\\V1\\Rest\\Competition\\Controller' => array(
                0 => 'application/vnd.dcm.v1+json',
                1 => 'application/json',
            ),
            'DCM\\V1\\Rest\\User\\Controller' => array(
                0 => 'application/vnd.dcm.v1+json',
                1 => 'application/json',
            ),
            'DCM\\V1\\Rest\\CompetitionGroup\\Controller' => array(
                0 => 'application/vnd.dcm.v1+json',
                1 => 'application/json',
            ),
            'DCM\\V1\\Rest\\CompetitionParticipant\\Controller' => array(
                0 => 'application/vnd.dcm.v1+json',
                1 => 'application/json',
            ),
            'DCM\\V1\\Rest\\CompetitionRatingCriterion\\Controller' => array(
                0 => 'application/vnd.dcm.v1+json',
                1 => 'application/json',
            ),
            'DCM\\V1\\Rest\\CompetitionRating\\Controller' => array(
                0 => 'application/vnd.dcm.v1+json',
                1 => 'application/json',
            ),
        ),
    ),
    'zf-content-validation' => array(
        'DCM\\V1\\Rest\\Competition\\Controller' => array(
            'input_filter' => 'DCM\\V1\\Rest\\Competition\\Validator',
        ),
        'DCM\\V1\\Rest\\User\\Controller' => array(
            'input_filter' => 'DCM\\V1\\Rest\\User\\Validator',
        ),
        'DCM\\V1\\Rest\\CompetitionGroup\\Controller' => array(
            'input_filter' => 'DCM\\V1\\Rest\\CompetitionGroup\\Validator',
        ),
        'DCM\\V1\\Rest\\CompetitionParticipant\\Controller' => array(
            'input_filter' => 'DCM\\V1\\Rest\\CompetitionParticipant\\Validator',
        ),
        'DCM\\V1\\Rest\\CompetitionRatingCriterion\\Controller' => array(
            'input_filter' => 'DCM\\V1\\Rest\\CompetitionRatingCriterion\\Validator',
        ),
        'DCM\\V1\\Rest\\CompetitionRating\\Controller' => array(
            'input_filter' => 'DCM\\V1\\Rest\\CompetitionRating\\Validator',
        ),
    ),
    'input_filter_specs' => array(
        'DCM\\V1\\Rpc\\Ping\\Validator' => array(
            0 => array(
                'name' => 'test',
                'required' => true,
                'filters' => array(),
                'validators' => array(),
                'allow_empty' => true,
                'continue_if_empty' => true,
            ),
        ),
        'DCM\\V1\\Rest\\Competition\\Validator' => array(
            0 => array(
                'name' => 'preliminary_of',
                'required' => false,
                'filters' => array(),
                'validators' => array(),
                'allow_empty' => true,
                'continue_if_empty' => true,
            ),
            1 => array(
                'name' => 'animexx_event_id',
                'required' => true,
                'filters' => array(),
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\I18n\\Validator\\Int',
                        'options' => array(),
                    ),
                ),
                'allow_empty' => false,
                'continue_if_empty' => false,
            ),
            2 => array(
                'name' => 'name',
                'required' => true,
                'filters' => array(),
                'validators' => array(),
                'allow_empty' => false,
                'continue_if_empty' => false,
            ),
            3 => array(
                'name' => 'date',
                'required' => true,
                'filters' => array(),
                'validators' => array(),
                'allow_empty' => false,
                'continue_if_empty' => false,
            ),
            4 => array(
                'name' => 'max_participants',
                'required' => true,
                'filters' => array(),
                'validators' => array(),
                'allow_empty' => false,
                'continue_if_empty' => false,
            ),
            5 => array(
                'name' => 'group_id',
                'required' => false,
                'filters' => array(),
                'validators' => array(),
                'allow_empty' => true,
                'continue_if_empty' => true,
            ),
        ),
        'DCM\\V1\\Rest\\User\\Validator' => array(
            0 => array(
                'name' => 'animexx_id',
                'required' => false,
                'filters' => array(),
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\I18n\\Validator\\Int',
                        'options' => array(),
                    ),
                ),
                'allow_empty' => true,
                'continue_if_empty' => true,
            ),
            1 => array(
                'name' => 'username',
                'required' => true,
                'filters' => array(
                    0 => array(
                        'name' => 'Zend\\Filter\\StringTrim',
                        'options' => array(),
                    ),
                ),
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\Validator\\StringLength',
                        'options' => array(
                            'max' => '50',
                        ),
                    ),
                ),
                'allow_empty' => false,
                'continue_if_empty' => false,
            ),
            2 => array(
                'name' => 'password',
                'required' => true,
                'filters' => array(),
                'validators' => array(),
                'allow_empty' => false,
                'continue_if_empty' => false,
            ),
            3 => array(
                'name' => 'sysadmin',
                'required' => false,
                'filters' => array(),
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\I18n\\Validator\\Int',
                        'options' => array(),
                    ),
                ),
                'allow_empty' => true,
                'continue_if_empty' => true,
            ),
        ),
        'DCM\\V1\\Rest\\CompetitionGroup\\Validator' => array(
            0 => array(
                'name' => 'name',
                'required' => true,
                'filters' => array(
                    0 => array(
                        'name' => 'Zend\\Filter\\StringTrim',
                        'options' => array(),
                    ),
                ),
                'validators' => array(),
                'allow_empty' => false,
                'continue_if_empty' => false,
            ),
        ),
        'DCM\\V1\\Rest\\CompetitionParticipant\\Validator' => array(
            0 => array(
                'name' => 'competition_id',
                'required' => true,
                'filters' => array(),
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\I18n\\Validator\\Int',
                        'options' => array(),
                    ),
                ),
            ),
            1 => array(
                'name' => 'user_id',
                'required' => true,
                'filters' => array(),
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\I18n\\Validator\\Int',
                        'options' => array(),
                    ),
                ),
            ),
            2 => array(
                'name' => 'name',
                'required' => true,
                'filters' => array(
                    0 => array(
                        'name' => 'Zend\\Filter\\StringTrim',
                        'options' => array(),
                    ),
                ),
                'validators' => array(),
            ),
            3 => array(
                'name' => 'data',
                'required' => true,
                'filters' => array(),
                'validators' => array(),
            ),
        ),
        'DCM\\V1\\Rest\\CompetitionRatingCriterion\\Validator' => array(
            0 => array(
                'name' => 'competition_group_id',
                'required' => true,
                'filters' => array(),
                'validators' => array(),
            ),
            1 => array(
                'name' => 'name',
                'required' => true,
                'filters' => array(
                    0 => array(
                        'name' => 'Zend\\Filter\\StringTrim',
                        'options' => array(),
                    ),
                ),
                'validators' => array(),
            ),
            2 => array(
                'name' => 'order',
                'required' => true,
                'filters' => array(),
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\I18n\\Validator\\Int',
                        'options' => array(),
                    ),
                ),
            ),
            3 => array(
                'name' => 'max_rating',
                'required' => true,
                'filters' => array(),
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\I18n\\Validator\\Int',
                        'options' => array(),
                    ),
                ),
            ),
        ),
        'DCM\\V1\\Rest\\CompetitionRating\\Validator' => array(
            0 => array(
                'name' => 'rating',
                'required' => true,
                'filters' => array(),
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\I18n\\Validator\\Int',
                        'options' => array(),
                    ),
                ),
            ),
            1 => array(
                'name' => 'adjucator',
                'required' => true,
                'filters' => array(),
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\I18n\\Validator\\Int',
                        'options' => array(),
                    ),
                ),
            ),
            2 => array(
                'name' => 'date',
                'required' => false,
                'filters' => array(),
                'validators' => array(),
                'allow_empty' => true,
                'continue_if_empty' => true,
            ),
        ),
    ),
    'service_manager' => array(
        'factories' => array(
            'DCM\\V1\\Rest\\Competition\\CompetitionResource' => 'DCM\\V1\\Rest\\Competition\\CompetitionResourceFactory',
            'DCM\\V1\\Rest\\User\\UserResource' => 'DCM\\V1\\Rest\\User\\UserResourceFactory',
            'DCM\\V1\\Rest\\CompetitionGroup\\CompetitionGroupResource' => 'DCM\\V1\\Rest\\CompetitionGroup\\CompetitionGroupResourceFactory',
            'DCM\\V1\\Rest\\CompetitionParticipant\\CompetitionParticipantResource' => 'DCM\\V1\\Rest\\CompetitionParticipant\\CompetitionParticipantResourceFactory',
            'DCM\\V1\\Rest\\CompetitionRatingCriterion\\CompetitionRatingCriterionResource' => 'DCM\\V1\\Rest\\CompetitionRatingCriterion\\CompetitionRatingCriterionResourceFactory',
            'DCM\\V1\\Rest\\CompetitionRating\\CompetitionRatingResource' => 'DCM\\V1\\Rest\\CompetitionRating\\CompetitionRatingResourceFactory',
        ),
    ),
    'zf-rest' => array(
        'DCM\\V1\\Rest\\Competition\\Controller' => array(
            'listener' => 'DCM\\V1\\Rest\\Competition\\CompetitionResource',
            'route_name' => 'dcm.rest.competition',
            'route_identifier_name' => 'competition_id',
            'collection_name' => 'competition',
            'entity_http_methods' => array(
                0 => 'GET',
                1 => 'POST',
                2 => 'PUT',
                3 => 'PATCH',
                4 => 'DELETE',
            ),
            'collection_http_methods' => array(
                0 => 'GET',
                1 => 'PUT',
                2 => 'POST',
                3 => 'PATCH',
                4 => 'DELETE',
            ),
            'collection_query_whitelist' => array(),
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => 'DCM\\V1\\Rest\\Competition\\CompetitionEntity',
            'collection_class' => 'DCM\\V1\\Rest\\Competition\\CompetitionCollection',
            'service_name' => 'Competition',
        ),
        'DCM\\V1\\Rest\\User\\Controller' => array(
            'listener' => 'DCM\\V1\\Rest\\User\\UserResource',
            'route_name' => 'dcm.rest.user',
            'route_identifier_name' => 'user_id',
            'collection_name' => 'user',
            'entity_http_methods' => array(
                0 => 'GET',
                1 => 'PATCH',
                2 => 'PUT',
                3 => 'DELETE',
            ),
            'collection_http_methods' => array(
                0 => 'GET',
                1 => 'POST',
            ),
            'collection_query_whitelist' => array(),
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => 'DCM\\V1\\Rest\\User\\UserEntity',
            'collection_class' => 'DCM\\V1\\Rest\\User\\UserCollection',
            'service_name' => 'User',
        ),
        'DCM\\V1\\Rest\\CompetitionGroup\\Controller' => array(
            'listener' => 'DCM\\V1\\Rest\\CompetitionGroup\\CompetitionGroupResource',
            'route_name' => 'dcm.rest.competition-group',
            'route_identifier_name' => 'group_id',
            'collection_name' => 'competition_group',
            'entity_http_methods' => array(
                0 => 'GET',
                1 => 'PATCH',
                2 => 'PUT',
                3 => 'DELETE',
            ),
            'collection_http_methods' => array(
                0 => 'GET',
                1 => 'POST',
            ),
            'collection_query_whitelist' => array(),
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => 'DCM\\V1\\Rest\\CompetitionGroup\\CompetitionGroupEntity',
            'collection_class' => 'DCM\\V1\\Rest\\CompetitionGroup\\CompetitionGroupCollection',
            'service_name' => 'CompetitionGroup',
        ),
        'DCM\\V1\\Rest\\CompetitionParticipant\\Controller' => array(
            'listener' => 'DCM\\V1\\Rest\\CompetitionParticipant\\CompetitionParticipantResource',
            'route_name' => 'dcm.rest.competition-participant',
            'route_identifier_name' => 'participant_id',
            'collection_name' => 'competition_participant',
            'entity_http_methods' => array(
                0 => 'GET',
                1 => 'PATCH',
                2 => 'PUT',
                3 => 'DELETE',
            ),
            'collection_http_methods' => array(
                0 => 'GET',
                1 => 'POST',
            ),
            'collection_query_whitelist' => array(),
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => 'DCM\\V1\\Rest\\CompetitionParticipant\\CompetitionParticipantEntity',
            'collection_class' => 'DCM\\V1\\Rest\\CompetitionParticipant\\CompetitionParticipantCollection',
            'service_name' => 'CompetitionParticipant',
        ),
        'DCM\\V1\\Rest\\CompetitionRatingCriterion\\Controller' => array(
            'listener' => 'DCM\\V1\\Rest\\CompetitionRatingCriterion\\CompetitionRatingCriterionResource',
            'route_name' => 'dcm.rest.competition-rating-criterion',
            'route_identifier_name' => 'criterion_id',
            'collection_name' => 'competition_rating_criterion',
            'entity_http_methods' => array(
                0 => 'GET',
                1 => 'PATCH',
                2 => 'PUT',
                3 => 'DELETE',
            ),
            'collection_http_methods' => array(
                0 => 'GET',
                1 => 'POST',
            ),
            'collection_query_whitelist' => array(),
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => 'DCM\\V1\\Rest\\CompetitionRatingCriterion\\CompetitionRatingCriterionEntity',
            'collection_class' => 'DCM\\V1\\Rest\\CompetitionRatingCriterion\\CompetitionRatingCriterionCollection',
            'service_name' => 'CompetitionRatingCriterion',
        ),
        'DCM\\V1\\Rest\\CompetitionRating\\Controller' => array(
            'listener' => 'DCM\\V1\\Rest\\CompetitionRating\\CompetitionRatingResource',
            'route_name' => 'dcm.rest.competition-rating',
            'route_identifier_name' => 'rating_id',
            'collection_name' => 'competition_rating',
            'entity_http_methods' => array(
                0 => 'GET',
                1 => 'PATCH',
                2 => 'PUT',
                3 => 'DELETE',
            ),
            'collection_http_methods' => array(
                0 => 'GET',
                1 => 'POST',
            ),
            'collection_query_whitelist' => array(),
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => 'DCM\\V1\\Rest\\CompetitionRating\\CompetitionRatingEntity',
            'collection_class' => 'DCM\\V1\\Rest\\CompetitionRating\\CompetitionRatingCollection',
            'service_name' => 'CompetitionRating',
        ),
    ),
    'zf-hal' => array(
        'metadata_map' => array(
            'DCM\\V1\\Rest\\Competition\\CompetitionEntity' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'dcm.rest.competition',
                'route_identifier_name' => 'competition_id',
                'hydrator' => 'Zend\\Stdlib\\Hydrator\\ObjectProperty',
            ),
            'DCM\\V1\\Rest\\Competition\\CompetitionCollection' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'dcm.rest.competition',
                'route_identifier_name' => 'competition_id',
                'is_collection' => true,
            ),
            'DCM\\V1\\Rest\\User\\UserEntity' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'dcm.rest.user',
                'route_identifier_name' => 'user_id',
                'hydrator' => 'Zend\\Stdlib\\Hydrator\\ObjectProperty',
            ),
            'DCM\\V1\\Rest\\User\\UserCollection' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'dcm.rest.user',
                'route_identifier_name' => 'user_id',
                'is_collection' => true,
            ),
            'DCM\\V1\\Rest\\CompetitionGroup\\CompetitionGroupEntity' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'dcm.rest.competition-group',
                'route_identifier_name' => 'group_id',
                'hydrator' => 'Zend\\Stdlib\\Hydrator\\ObjectProperty',
            ),
            'DCM\\V1\\Rest\\CompetitionGroup\\CompetitionGroupCollection' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'dcm.rest.competition-group',
                'route_identifier_name' => 'group_id',
                'is_collection' => true,
            ),
            'DCM\\V1\\Rest\\CompetitionParticipant\\CompetitionParticipantEntity' => array(
                'entity_identifier_name' => 'user_id',
                'route_name' => 'dcm.rest.competition-participant',
                'route_identifier_name' => 'participant_id',
                'hydrator' => 'Zend\\Stdlib\\Hydrator\\ObjectProperty',
            ),
            'DCM\\V1\\Rest\\CompetitionParticipant\\CompetitionParticipantCollection' => array(
                'entity_identifier_name' => 'user_id',
                'route_name' => 'dcm.rest.competition-participant',
                'route_identifier_name' => 'participant_id',
                'is_collection' => true,
            ),
            'DCM\\V1\\Rest\\CompetitionRatingCriterion\\CompetitionRatingCriterionEntity' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'dcm.rest.competition-rating-criterion',
                'route_identifier_name' => 'criterion_id',
                'hydrator' => 'Zend\\Stdlib\\Hydrator\\ObjectProperty',
            ),
            'DCM\\V1\\Rest\\CompetitionRatingCriterion\\CompetitionRatingCriterionCollection' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'dcm.rest.competition-rating-criterion',
                'route_identifier_name' => 'criterion_id',
                'is_collection' => true,
            ),
            'DCM\\V1\\Rest\\CompetitionRating\\CompetitionRatingEntity' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'dcm.rest.competition-rating',
                'route_identifier_name' => 'rating_id',
                'hydrator' => 'Zend\\Stdlib\\Hydrator\\ObjectProperty',
            ),
            'DCM\\V1\\Rest\\CompetitionRating\\CompetitionRatingCollection' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'dcm.rest.competition-rating',
                'route_identifier_name' => 'rating_id',
                'is_collection' => true,
            ),
        ),
    ),
);
