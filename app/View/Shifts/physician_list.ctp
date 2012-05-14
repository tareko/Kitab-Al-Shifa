<?php
	echo $this->Form->create();

	echo $this->PhysicianPicker->makePhysicianPicker($physicians);

	echo $this->Form->submit();

	echo $this->Js->writeBuffer(); // Write cached scripts
?>
