<?php
	use Symfony\Component\Console\Input\InputArgument,
		Symfony\Component\Console\Input\InputOption,
		Symfony\Component\Console;
	
	class CommandName extends MindCommand implements program
	{
		public function configure()
		{
			$this->setName('Mind:commandName')
				 ->setDescription('CommandDescription')
				 ->setDefinition(array(
						new InputArgument('arg1', InputArgument::REQUIRED, 'ArgDescription.'),
						new InputOption(
						    'Option', null, InputOption::PARAMETER_REQUIRED,
						    'Description of the option',
						    'object'
						),
						new InputOption(
						    'first-result', null, InputOption::PARAMETER_REQUIRED,
						    'The first result in the result set.'
						)
					))
				 ->setHelp(<<<EOT
			Executes arbitrary DQL directly from the command line.
EOT
					);
		}
		public function execute(Console\Input\InputInterface $input, Console\Output\OutputInterface $output)
		{
			$this->runAction();
		}

		public function HTTPExecute()
		{
			$this->runAction();
		}

		private function action()
		{
			return $this;
		}

		public function runAction()
		{
			return $this->action();
		}
	}
