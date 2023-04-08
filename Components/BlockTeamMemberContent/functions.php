<?php

namespace Flynt\Components\BlockTeamMemberContent;

use Flynt\Utils\TimberDynamicResize;
use Timber;

add_filter('Flynt/addComponentData?name=BlockTeamMemberContent', function ($data) {
    $data['avatar_image'] = new Timber\Image($data['post']->avatar);

    return $data;
});
