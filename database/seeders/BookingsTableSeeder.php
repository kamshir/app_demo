<?php

namespace Database\Seeders;

use App\Models\Bookable;
use App\Models\Booking;
use Illuminate\Database\Seeder;

class BookingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Bookable::all()->each(function (Bookable $bookable) {
            $booking = Booking::factory()->make(); //Crea una reserva aleatoria
            $bookings = collect([$booking]); //Añade la primera reserva

            for ($i = 0; $i < random_int(1, 20); $i++) { //Añadirá un número aleatorio de reservas entre 1 y 20
                //Clona la fecha desde original y le añade dias
                $from = (clone $booking['to'])->addDays(random_int(1, 14));
                //Clona la fecha desde original y le añade un número aleatorio de dias entre 0 y 14
                $to = (clone $from)->addDays(random_int(0, 14));

                $booking = Booking::make([
                    'from' => $from,
                    'to' => $to
                ]);

                //Añade la reserva creada con las nuevas fechas
                $bookings->push($booking);
            }

            $bookable->bookings()->saveMany($bookings);
        });
    }
}
$booking = Booking::factory()->make();  // change 