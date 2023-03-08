<?php

function local_showdata_extend_settings_navigation($settingsnav, $context) {
    global $CFG, $PAGE;

    // Only add this settings item on non-site course pages.
    if (!$PAGE->course or $PAGE->course->id == 1) {
        return;
    }

    // Only let users with the appropriate capability see this settings item.
    if (!has_capability('moodle/backup:backupcourse', context_course::instance($PAGE->course->id))) {
        return;
    }

    if ($settingnode = $settingsnav->find('courseadmin', navigation_node::TYPE_COURSE)) {
        $strshowdata = get_string('showdata', 'local_showdata');
        $url = new moodle_url('/local/myplugin/showdata.php', array('id' => $PAGE->course->id));
        $showdatanode = navigation_node::create(
            $strshowdata,
            $url,
            navigation_node::NODETYPE_LEAF,
            'myplugin',
            'myplugin',
            new pix_icon('t/addcontact', $strshowdata)
        );
        if ($PAGE->url->compare($url, URL_MATCH_BASE)) {
            $showdatanode->make_active();
        }
        $settingnode->add_node($showdatanode);
    }
}
