<?php
namespace infobip\api\model\omni\scenarios;

/**
 * This is a generated class and is not intended for modification!
 */
class Step implements \JsonSerializable
{
    private $from;
    private $channel;


    public function setFrom($from)
    {
        $this->from = $from;
    }
    public function getFrom()
    {
        return $this->from;
    }

    public function setChannel($channel)
    {
        $this->channel = $channel;
    }
    public function getChannel()
    {
        return $this->channel;
    }


  /**
   * (PHP 5 &gt;= 5.4.0)<br/>
   * Specify data which should be serialized to JSON
   * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
   * @return mixed data which can be serialized by <b>json_encode</b>,
   * which is a value of any type other than a resource.
   */
  function jsonSerialize()
  {
      return get_object_vars($this);
  }
}