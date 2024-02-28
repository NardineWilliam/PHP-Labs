<?php
class Visitor
{
    public static function getUniqueVisitorId()
    {
        return session_id();
    }
}
