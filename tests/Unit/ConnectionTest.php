<?php

namespace Tests\Unit;

use App\Models\Connection;
use Carbon\Carbon;
use Tests\TestCase;

class ConnectionTest extends TestCase
{
    /** @test */
    public function it_can_calculate_leave_in_minutes_within_twenty_minutes_of_a_connection()
    {
        // Arrange
        Carbon::setTestNow(Carbon::create(2019, 3, 20, 12, 0));
        $departure = Carbon::now()->addMinutes(30)->timestamp;
        $connection = Connection::make([
            'departure' => $departure,
            'time_to_station' => 10,
        ]);

        // Act
        $leaveIn = $connection->leaveInMinutes();

        // Assert
        $this->assertEquals(20, $leaveIn);
    }

    /** @test */
    public function it_can_calculate_floored_leave_in_minutes_within_twenty_minutes_of_a_connection()
    {
        // Arrange
        Carbon::setTestNow(Carbon::create(2019, 3, 20, 12, 0));
        $departure = Carbon::now()->addMinutes(30)->addSeconds(34)->timestamp;
        $connection = Connection::make([
            'departure' => $departure,
            'time_to_station' => 10,
        ]);

        // Act
        $leaveIn = $connection->leaveInMinutes();

        // Assert
        $this->assertEquals(20, $leaveIn);
    }

    /** @test */
    public function it_can_calculate_leave_in_value_in_two_a_half_hours_of_a_connection()
    {
        // Arrange
        Carbon::setTestNow(Carbon::create(2019, 3, 20, 12, 0));
        $departure = Carbon::now()->addMinutes(30)->addHours(2)->timestamp;
        $connection = Connection::make([
            'departure' => $departure,
            'time_to_station' => 10,
        ]);

        // Act
        $leaveIn = $connection->leaveInMinutes();

        // Assert
        $this->assertEquals(140, $leaveIn);
    }
}
