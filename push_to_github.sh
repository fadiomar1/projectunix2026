#!/bin/bash

echo "Adding files..."
git add .

echo "Committing changes..."
git commit -m "Upload sum application project"

echo "Pushing to GitHub..."
git push -u origin main

echo "Done."
