# Define a default target
.DEFAULT_GOAL := all

# Variables
PYTHON := python
CONDA := conda

# Targets
all: setup run

setup:
	@echo "Setting up the environment..."
	$(PYTHON) setup.py

run:
	@echo "Running the main script..."
	$(PYTHON) src/main/service.py

test:
	@echo "Running tests..."
	$(PYTHON) -m unittest discover -s tests

.PHONY: all setup run test