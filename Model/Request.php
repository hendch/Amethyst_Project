<?php

class request
{
    private int $userid;
    private string $reqtype;
    private string $reqdate;
    private string $servicestatus;

    public function __construct(int $userid, string $reqtype, string $reqdate, string $servicestatus)
    {
        $this->userid = $userid;
        $this->reqtype = $reqtype;
        $this->reqdate = $reqdate;
        $this->servicestatus = $servicestatus;
    }
    public function getuserid()
    {
        return $this->userid;
    }
    public function setuserid($userid)
    {
        $this->userid = $userid;
        return $this;
    }

    public function getreqtype()
    {
        return $this->reqtype;
    }
    public function setreqtype($reqtype)
    {
        $this->reqtype = $reqtype;
        return $this;
    }

    public function getreqdate()
    {
        return $this->reqdate;
    }
    public function setreqdate($reqdate)
    {
        $this->reqdate = $reqdate;
        return $this;
    }

    public function getservicestatus()
    {
        return $this->servicestatus;
    }
    public function setservicestatus($servicestatus)
    {
        $this->servicestatus = $servicestatus;
        return $this;
    }
}
?>