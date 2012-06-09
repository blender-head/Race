<?php

	$query = $this->site_info->get_site_info();
	
	if(count($query) > 0)
	{
		foreach($query as $row)
		{
			$site_title = $row->site_title;	
			$site_title_sub = $row->site_title_sub;
			$site_track = $row->site_track;
		}
	}
        else
        {
            $site_title = '';	
            $site_title_sub = '';
            $site_track = '';
        }


