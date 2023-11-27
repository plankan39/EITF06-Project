FROM python:latest

WORKDIR /app

# Install dependencies.
ADD ./payment/SimpleCoin/requirements.txt /app
RUN cd /app && \
  pip install -r requirements.txt

# Add actual source code.
ADD ./payment/SimpleCoin/simpleCoin/miner.py /app
ADD ./payment/SimpleCoin/simpleCoin/miner_config.py /app

EXPOSE 5000

CMD ["python", "miner.py", "--port", "5000"]
