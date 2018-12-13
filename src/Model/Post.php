<?php
namespace d8devs\socialposter\Model;

/**
 * Description of Post
 *
 * @author Koray Zorluoglu <koray@d8devs.com>
 */
class Post
{
    /** @var string twitter|facebook|instagram */
    private $for;
    
    /** @var mixed */
    private $target;
    
    /** @var mixed string|html */
    private $message;
    
    /** @var mixed array|null File Paths */
    private $attachments;
    
    /** @var array mixed **/
    private $report;
    
    public function __construct($for, $target, $message, $attachments = null)
    {
        $this->for = $for;
        $this->target = $target;
        $this->message = $message;
        $this->attachments = $attachments;
    }
    
    public function getFor()
    {
        return $this->for;
    }
    
    public function getTarget()
    {
        return $this->target;
    }
    
    public function getMessage()
    {
        return $this->message;
    }

    public function getAttachments()
    {
        return $this->attachments;
    }

    public function getReport($key)
    {
        if (array_key_exists($key, $this->report)) {
            return $this->report[$key];
        }
    }

    public function setReport($key, $value)
    {
        $this->report[$key] = $value;
    }
}
