package main

import (
	"fmt"
	"github.com/Shopify/sarama"
	"time"
)

func main() {
	producer := NewSyncProducer()
	defer func() {
		_ = producer.Close()
	}()

	_, _, err := producer.SendMessage(&sarama.ProducerMessage{
		Topic: "demo-topic",
		Value: sarama.StringEncoder(fmt.Sprintf("demo kafka topic val, t=%d", time.Now().Unix())),
	})
	if nil != err {
		fmt.Printf("producer SendMessage err %v", err)
		return
	}
	fmt.Printf("Done")
}

func NewSyncProducer() sarama.SyncProducer {
	brokerList := []string{"127.0.0.1:9092"}

	config := sarama.NewConfig()
	config.Producer.RequiredAcks = sarama.WaitForAll // Wait for all in-sync replicas to ack the message
	config.Producer.Retry.Max = 10                   // Retry up to 10 times to produce the message
	config.Producer.Return.Successes = true

	producer, err := sarama.NewSyncProducer(brokerList, config)
	if err != nil {
		panic(fmt.Sprintf("NewSyncProducer err %v", err))
	}

	return producer
}
