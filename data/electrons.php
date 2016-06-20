<?php
// electrons and stuff go here
$electrons = [
	'H'  => ['block' => 's'],
	'He' => ['block' => 's'],
	'Li' => ['block' => 's'],
	'Be' => ['block' => 's'],
	'B'  => ['block' => 'p'],
	'C'  => ['block' => 'p'],
	'N'  => ['block' => 'p'],
	'O'  => ['block' => 'p'],
	'F'  => ['block' => 'p'],
	'Ne' => ['block' => 'p'],
	'Na' => ['block' => 's'], 
	'Mg' => ['block' => 's'],
	'Al' => ['block' => 'p'],
	'Si' => ['block' => 'p'],
	'P'  => ['block' => 'p'],
	'S'  => ['block' => 'p'],
	'Cl' => ['block' => 'p'],
	'Ar' => ['block' => 'p'],
	'K'  => ['block' => 's'],
	'Ca' => ['block' => 's'],
	'Sc' => ['block' => 'd'],
	'Ti' => ['block' => 'd'],
	'V'  => ['block' => 'd'],
	'Cr' => ['block' => 'd'],
	'Mn' => ['block' => 'd'],
	'Fe' => ['block' => 'd'],
	'Co' => ['block' => 'd'],
	'Ni' => ['block' => 'd'],
	'Cu' => ['block' => 'd'],
	'Zn' => ['block' => 'd'],
	'Ga' => ['block' => 'p'],
	'Ge' => ['block' => 'p'],
	'As' => ['block' => 'p'],
	'Se' => ['block' => 'p'],
	'Br' => ['block' => 'p'],
	'Kr' => ['block' => 'p'],
	'Rb' => ['block' => 's'],
	'Sr' => ['block' => 's'],
	'Y'  => ['block' => 'd'],
	'Zr' => ['block' => 'd'],
	'Nb' => ['block' => 'd'],
	'Mo' => ['block' => 'd'],
	'Tc' => ['block' => 'd'],
	'Ru' => ['block' => 'd'],
	'Rh' => ['block' => 'd'], 
	'Pd' => ['block' => 'd'],
	'Ag' => ['block' => 'd'],
	'Cd' => ['block' => 'd'],
	'In' => ['block' => 'p'],
	'Sn' => ['block' => 'p'],
	'Sb' => ['block' => 'p'],
	'Te' => ['block' => 'p'],
	'I'  => ['block' => 'p'],
	'Xe' => ['block' => 'p'],
	'Cs' => ['block' => 's'],
	'Ba' => ['block' => 's'],
	'La' => ['block' => 'f'],
	'Ce' => ['block' => 'f'],
	'Pr' => ['block' => 'f'],
	'Nd' => ['block' => 'f'],
	'Pm' => ['block' => 'f'],
	'Sm' => ['block' => 'f'],
	'Eu' => ['block' => 'f'],
	'Gd' => ['block' => 'f'],
	'Tb' => ['block' => 'f'],
	'Dy' => ['block' => 'f'],
	'Ho' => ['block' => 'f'],
	'Er' => ['block' => 'f'],
	'Tm' => ['block' => 'f'],
	'Yb' => ['block' => 'f'],
	'Lu' => ['block' => 'd'],
	'Hf' => ['block' => 'd'],
	'Ta' => ['block' => 'd'],
	'W'  => ['block' => 'd'],
	'Re' => ['block' => 'd'],
	'Os' => ['block' => 'd'],
	'Ir' => ['block' => 'd'],
	'Pt' => ['block' => 'd'],
	'Au' => ['block' => 'd'],
	'Hg' => ['block' => 'd'],
	'Tl' => ['block' => 'p'],
	'Pb' => ['block' => 'p'],
	'Bi' => ['block' => 'p'],
	'Po' => ['block' => 'p'],
	'At' => ['block' => 'p'],
	'Rn' => ['block' => 'p'],
	'Fr' => ['block' => 's'],
	'Ra' => ['block' => 's'],
	'Ac' => ['block' => 'f'],
	'Th' => ['block' => 'f'],
	'Pa' => ['block' => 'f'],
	'U'  => ['block' => 'f'],
	'Np' => ['block' => 'f'],
	'Pu' => ['block' => 'f'],
	'Am' => ['block' => 'f'],
	'Cm' => ['block' => 'f'],
	'Bk' => ['block' => 'f'],
	'Cf' => ['block' => 'f'],
	'Es' => ['block' => 'f'],
	'Fm' => ['block' => 'f'],
	'Md' => ['block' => 'f'],
	'No' => ['block' => 'f'],
	'Lr' => ['block' => 'd'],
	'Rf' => ['block' => 'd'],
	'Db' => ['block' => 'd'],
	'Sg' => ['block' => 'd'],
	'Bh' => ['block' => 'd'],
	'Hs' => ['block' => 'd'],
	'Mt' => ['block' => 'd'],
	'Ds' => ['block' => 'd'],
	'Rg' => ['block' => 'd'],
	'Cn' => ['block' => 'd'],
	'Uut' => ['block' => 'p'],
	'Fl'  => ['block' => 'p'],
	'Uup' => ['block' => 'p'],
	'Lv'  => ['block' => 'p'],
	'Uus' => ['block' => 'p'],
	'Uuo' => ['block' => 'p']
];

// hack for tests
// todo refactor
if (!function_exists('electron_config')) {
	function electron_config($element_number, $shortened = false)
	{
		// Check for exceptions
		$exceptions = [
				24 => '1s2 2s2 2p6 3s2 3p6 4s1 3d5',
				29 => '1s2 2s2 2p6 3s2 3p6 4s1 3d10',
				41 => '1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p6 5s1 4d4',
				42 => '1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p6 5s1 4d5',
				44 => '1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p6 5s1 4d7',
				45 => '1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p6 5s1 4d8',
				46 => '1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p6 4d10',
				47 => '1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p6 5s1 4d10',
				57 => '1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p6 5s2 4d10 5p6 6s2 5d1',
				58 => '1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p6 5s2 4d10 5p6 6s2 4f1 5d1',
				64 => '1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p6 5s2 4d10 5p6 6s2 4f7 5d1',
				78 => '1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p6 5s2 4d10 5p6 6s1 4f14 5d9',
				79 => '1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p6 5s2 4d10 5p6 6s1 4f14 5d10',
				89 => '1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p6 5s2 4d10 5p6 6s2 4f14 5d10 6p6 7s2 6d1',
				90 => '1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p6 5s2 4d10 5p6 6s2 4f14 5d10 6p6 7s2 6d2',
				91 => '1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p6 5s2 4d10 5p6 6s2 4f14 5d10 6p6 7s2 5f2 6d1',
				92 => '1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p6 5s2 4d10 5p6 6s2 4f14 5d10 6p6 7s2 5f3 6d1',
				93 => '1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p6 5s2 4d10 5p6 6s2 4f14 5d10 6p6 7s2 5f4 6d1',
				96 => '1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p6 5s2 4d10 5p6 6s2 4f14 5d10 6p6 7s2 5f7 6d1',
				103 => '1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p6 5s2 4d10 5p6 6s2 4f14 5d10 6p6 7s2 5f14 7p1'
		];
		if (array_key_exists($element_number, $exceptions)) {
			$notation_exception = $exceptions[$element_number];
		}

		$orbital_capacity = [
				's' => 2,
				'p' => 6,
				'd' => 10,
				'f' => 14
		];

		$notation_order = [
				'1s', '2s', '2p', '3s', '3p',
				'4s', '3d', '4p', '5s', '4d',
				'5p', '6s', '4f', '5d', '6p',
				'7s', '5f', '6d', '7p', '8s',
		];

		$electrons = $element_number;
		$notation = '';

		foreach ($notation_order as $orbital) {
			$orbital_type = substr($orbital, -1);
			$orbital_value = 0;
			while ($electrons > 0 && $orbital_value < $orbital_capacity[$orbital_type]) {
				$orbital_value++;
				$electrons--;
			}
			$notation .= $orbital . $orbital_value;
			if ($electrons === 0) {
				break;
			} else {
				$notation .= ' ';
			}
		}

		if (isset($notation_exception)) {
			$notation = $notation_exception;
		}

		// Optionally shorten the notation
		$noble_gases = [
				'He' => 2,
				'Ne' => 10,
				'Ar' => 18,
				'Kr' => 36,
				'Xe' => 54,
				'Rn' => 86,
		];

		if ($shortened) {
			foreach (array_reverse($noble_gases) as $key => $gas) {
				if ($element_number > $gas) {
					$replace_notation = electron_config($gas, false);
					$shortened_notation = '[' . $key . ']';
					return str_replace($replace_notation, $shortened_notation, $notation);
				}
			}
		}

		return $notation;
	}
}

return $electrons;
