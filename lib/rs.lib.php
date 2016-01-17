<?
class Rs{ 

	private $result;
	private $rowcount;
	private $cant;
	
	private $err;
	
	function __construct($result)
	{
		$this->result=$result;
		if ($this->result)
		{
			$this->RowCount();
		}
		else
		{
			$this->rowcount=0;
		}
		$this->cant=0;
	}
			
	function Registros()
	{
		if (($this->cant)<($this->rowcount))
		{		
			if ($this->rs=mysql_fetch_array($this->result))
			{
				$this->cant++;
				$boolean="true";
			}
			else
			{
				$boolean="false";
			}
		}
		return $boolean;
	}

	
	function getCampo($campo)
	{
		return  $this->rs[$campo];
	}
	
	
	
	function RowCount()
	{
		$this->rowcount=mysql_num_rows($this->result);
	}
	
	function getRowCount()
	{
		return $this->rowcount;
	}
	
	
	function Err()
	{
		$this->err=mysql_errno().": ".mysql_error();
	}
	
	function getErr()
	{
		return $this->err;
	}
	
}

?>