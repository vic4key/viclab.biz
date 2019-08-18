<?php
	try
	{
		$jdata = ICloudFlare::Instance()->QueryVisitors(CF_UV_MONTH);
		jassert($jdata);
		printf("In the last %s, total %d visitors, at most %d and at least %d visitors per %s.",
			$jdata->unit_time,
			$jdata->total_visitors,
			$jdata->max_visitors,
			$jdata->min_visitors,
			$jdata->per_time
		);
	}
	catch(Exception $exception)
	{
		// the exceptions are handling here
	}
?>