<?php
interface TimeToWordConverteringInterface
{
    public function convert(int $hours, int $minutes): string;
}